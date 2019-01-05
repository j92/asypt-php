<?php

final class Md5Digester
{
    /**
     * @var int
     */
    private $iterations;

    public function __construct(int $iterations = 1000)
    {
        $this->iterations = $iterations;
    }

    public function digest(string $password, string $salt): string
    {
        $passAndSalt = array_merge($this->getBytes($password), $this->getBytes($salt));
        for ($i = 0; $i < $this->iterations; $i++) {
            $passAndSalt = $this->getBytes(md5($this->getString($passAndSalt), true));
        }
        return base64_encode($this->getString($passAndSalt));
    }

    private function getBytes(string $message): array
    {
        $bytes = array_slice(unpack('C*', "\0" . $message), 1);
        $bytes = array_map('decbin', $bytes);
        return $bytes;
    }

    private function getString(array $bytes): string
    {
        $bytes = array_map('bindec', $bytes);
        return pack(...array_merge(array('C*'), $bytes));
    }
}
