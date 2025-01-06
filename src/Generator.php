<?php

namespace Perfocard\Flog;

use Symfony\Component\Process\Process;

class Generator
{
    protected string $binary;

    public function __construct()
    {
        $platform = config('flog.platform');
        $this->binary = base_path("vendor/perfocard/flog/bin/{$platform}/flog");
    }

    public function generate(int $lines = 1, string $format = 'rfc5424'): array
    {
        $process = new Process([$this->binary, '-f', $format, '-n', $lines]);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new \RuntimeException($process->getErrorOutput());
        }

        // Розбиваємо результат на масив рядків
        $output = $process->getOutput();
        $logs = explode("\n", trim($output));

        // Повертаємо масив без порожніх рядків
        return array_filter($logs);
    }

    public function generateOne(string $format = 'rfc5424'): string
    {
        $logs = $this->generate(1, $format);

        return $logs[0] ?? throw new \RuntimeException("Failed to generate a single log.");
    }
}
