<?php

    declare(strict_types=1);

    namespace Anibalealvarezs\AmazonApi\Amazon\Support;

    use Exception;
    use GuzzleHttp\Exception\RequestException;

    final class AmazonErrorClassifier
    {
        /**
         * @param mixed $input
         * @return array<string, mixed>
         */
        public static function normalize(mixed $input): array
        {
            $payload = self::extractPayload($input);
            $errors = is_array($payload['errors'] ?? null) ? $payload['errors'] : [];
            $firstError = is_array($errors[0] ?? null) ? $errors[0] : [];

            return [
                'message' => self::normalizeString($firstError['message'] ?? null) ?? self::extractMessageFallback($input),
                'code'    => self::normalizeString($firstError['code'] ?? null),
                'status'  => self::extractStatusCode($input),
                'raw'     => $firstError,
            ];
        }

        /**
         * @param mixed $input
         * @return array<string, mixed>
         */
        public static function classify(mixed $input): array
        {
            $normalized = self::normalize($input);
            $message = strtolower((string)($normalized['message'] ?? ''));
            $code = strtolower((string)($normalized['code'] ?? ''));
            $status = $normalized['status'];

            if (
                in_array($status, [429], true)
                || in_array($code, ['toomanyrequests', 'throttling', 'requestthrottled', 'quotaexceeded'], true)
                || str_contains($message, 'too many requests')
                || str_contains($message, 'rate exceeded')
                || str_contains($message, 'rate limit')
                || str_contains($message, 'throttl')
                || str_contains($message, 'quota exceeded')
            ) {
                return [
                    'category'     => 'retryable',
                    'reason'       => 'amazon_rate_limit',
                    'should_retry' => true,
                    'delay_ms'     => 1000,
                ];
            }
        
            return [
                'category'     => 'unknown',
                'reason'       => 'amazon_unknown',
                'should_retry' => false,
                'delay_ms'     => 0,
            ];
        }

        public static function isRetryable(mixed $input): bool
        {
            return self::classify($input)['should_retry'] === true;
        }

        /**
         * @param mixed $input
         * @return array<string, mixed>
         */
        private static function extractPayload(mixed $input): array
        {
            if (is_array($input)) {
                return $input;
            }

            if ($input instanceof RequestException && $input->hasResponse()) {
                $body = $input->getResponse()->getBody();
                $body->rewind();
                $contents = json_decode($body->getContents(), true);
                $body->rewind();

                return is_array($contents) ? $contents : [];
            }

            if ($input instanceof Exception) {
                $prev = $input->getPrevious();
                if ($prev instanceof RequestException && $prev->hasResponse()) {
                    return self::extractPayload($prev);
                }

                $fromMessage = json_decode($input->getMessage(), true);

                return is_array($fromMessage) ? $fromMessage : [];
            }

            if (is_string($input)) {
                $contents = json_decode($input, true);

                return is_array($contents) ? $contents : [];
            }

            return [];
        }

        private static function extractMessageFallback(mixed $input): ?string
        {
            if ($input instanceof Exception) {
                return $input->getMessage();
            }

            return self::normalizeString($input);
        }

        private static function normalizeString(mixed $value): ?string
        {
            if (!is_string($value) && !is_numeric($value)) {
                return null;
            }

            $normalized = trim((string)$value);

            return $normalized === '' ? null : $normalized;
        }

        private static function extractStatusCode(mixed $input): ?int
        {
            if ($input instanceof RequestException && $input->hasResponse()) {
                return $input->getResponse()->getStatusCode();
            }

            if ($input instanceof Exception) {
                if ($input->getCode() > 0) {
                    return (int)$input->getCode();
                }

                $prev = $input->getPrevious();
                if ($prev instanceof RequestException && $prev->hasResponse()) {
                    return $prev->getResponse()->getStatusCode();
                }
            }

            if (is_array($input) && isset($input['status']) && is_numeric($input['status'])) {
                return (int)$input['status'];
            }

            return null;
        }
    }

