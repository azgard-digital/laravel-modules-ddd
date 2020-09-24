<?php
declare(strict_types=1);

namespace App\Exceptions;

use Exception;
use App\Enums\HttpStatuses;
use Illuminate\Support\MessageBag;
use Symfony\Component\HttpKernel\Exception\HttpException;

class WalletsLimitException extends HttpException implements MessageBagErrors
{
    /**
     * MessageBag errors.
     *
     * @var \Illuminate\Support\MessageBag
     */
    protected $errors;

    /**
     * Create a new resource exception instance.
     *
     * @param string $message
     * @param \Illuminate\Support\MessageBag|array $errors
     * @param \Exception $previous
     * @param array $headers
     * @param int $code
     *
     * @return void
     */
    public function __construct($message = null, $errors = null, Exception $previous = null, $headers = [], $code = 0)
    {
        if (is_null($errors)) {
            $this->errors = new MessageBag;
        } else {
            $this->errors = is_array($errors) ? new MessageBag($errors) : $errors;
        }

        parent::__construct(HttpStatuses::value('forbidden'), $message, $previous, $headers, $code);
    }

    /**
     * Get the errors message bag.
     *
     * @return \Illuminate\Support\MessageBag
     */
    public function getErrors(): MessageBag
    {
        return $this->errors;
    }

    /**
     * Determine if message bag has any errors.
     *
     * @return bool
     */
    public function hasErrors(): bool
    {
        return !$this->errors->isEmpty();
    }
}
