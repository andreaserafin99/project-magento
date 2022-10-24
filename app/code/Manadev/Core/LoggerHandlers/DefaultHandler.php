<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\Core\LoggerHandlers;

use Magento\Framework\Filesystem\DriverInterface;
use Magento\Framework\Logger\Handler\Base;
use Monolog\Formatter\LineFormatter;
use Monolog\Logger;

class DefaultHandler extends Base
{
    /**
     * @var string
     */
    protected $fileName = '/var/log/mana.log';

    /**
     * @var int
     */
    protected $loggerType = Logger::DEBUG;

    /**
     * @param DriverInterface $filesystem
     * @param string $filePath
     */
    public function __construct(DriverInterface $filesystem, $filePath = null)
    {
        parent::__construct($filesystem, $filePath);
        $this->pushProcessor(function ($record) {
            if (isset($record['context']['file'])) {
                $record['file'] = $record['context']['file'];
                unset($record['context']['file']);
            }
            return $record;
        });
        $this->setFormatter(new LineFormatter("%datetime%: %message%\n", null, true));
    }

    public function __destruct()
    {
        try {
            $this->close();
        } catch (\Exception $e) {
            // do nothing
        } catch (\Throwable $e) {
            // do nothing
        }
    }
}
