<?php

namespace Perfocard\Flog;

use Symfony\Component\Process\Process;

class Generator
{
    protected static function getBinaryPath(): string
    {
        $platform = config('flog.platform');
        $binaryPath = str_replace('{platform}', $platform, config('flog.binary_path'));

        if (!file_exists($binaryPath)) {
            throw new \RuntimeException("Binary file not found at: {$binaryPath}");
        }

        return $binaryPath;
    }

    /**
     * Generate a specified number of log lines in the given format.
     *
     * @param int $lines The number of log lines to generate.
     * @param string $format The format of the log lines (default: 'rfc5424').
     * @return array An array of generated log lines.
     *
     * @throws \RuntimeException If the process fails to generate logs.
     */
    public static function generate(int $lines = 1, string $format = 'rfc5424'): array
    {
        $binaryPath = self::getBinaryPath();

        // Construct the process to execute the flog binary with the specified options.
        $process = new Process([
            $binaryPath,
            '-f', $format,
            '-n', $lines,
        ]);

        // Run the process.
        $process->run();

        // Check if the process was successful, otherwise throw an exception.
        if (! $process->isSuccessful()) {
            throw new \RuntimeException($process->getErrorOutput());
        }

        // Split the output into an array of lines.
        $output = $process->getOutput();
        $logs = explode("\n", trim($output));

        // Filter out any empty lines and return the result.
        return array_filter($logs);
    }

    /**
     * Generate a single log line in the specified format.
     *
     * @param string $format The format of the log line (default: 'rfc5424').
     * @return string The generated log line.
     *
     * @throws \RuntimeException If the process fails to generate a log line.
     */
    public static function generateOne(string $format = 'rfc5424'): string
    {
        // Use the generate method to create a single log line.
        $logs = self::generate(1, $format);

        // Return the first log line or throw an exception if none are generated.
        return $logs[0] ?? throw new \RuntimeException("Failed to generate a single log.");
    }
}
