<?php
namespace verbb\giftvoucher\base;

use verbb\giftvoucher\GiftVoucher;
use verbb\giftvoucher\integrations\klaviyoconnect\KlaviyoConnect;
use verbb\giftvoucher\services\CodesService;
use verbb\giftvoucher\services\PdfService;
use verbb\giftvoucher\services\RedemptionsService;
use verbb\giftvoucher\services\VouchersService;
use verbb\giftvoucher\services\VoucherTypesService;
use verbb\giftvoucher\storage\CodeStorageInterface;

use Craft;
use craft\log\FileTarget;
use craft\web\View;

use yii\base\Event;
use yii\log\Logger;

use verbb\base\BaseHelper;

trait PluginTrait
{
    // Static Properties
    // =========================================================================

    public static $plugin;


    // Public Methods
    // =========================================================================


    /**
     * getCodes
     *
     *
     * @return object|CodesService
     *
     * @author Robin Schambach
     * @since  21.06.2021
     */
    public function getCodes(): CodesService
    {
        return $this->get('codes');
    }

    /**
     * getCodes
     *
     *
     * @return object|null|PdfService
     *
     * @author Robin Schambach
     * @since  15.01.2021
     */
    public function getPdf(): PdfService
    {
        return $this->get('pdf');
    }

    /**
     * getRedemptions
     *
     *
     * @return \verbb\giftvoucher\services\RedemptionsService
     *
     * @author Robin Schambach
     * @since  21.06.2021
     */
    public function getRedemptions(): RedemptionsService
    {
        return $this->get('redemptions');
    }

    /**
     * getVouchers
     *
     *
     * @return \verbb\giftvoucher\services\VouchersService
     *
     * @author Robin Schambach
     * @since  21.06.2021
     */
    public function getVouchers(): VouchersService
    {
        return $this->get('vouchers');
    }

    /**
     * getVoucherTypes
     *
     *
     * @return \verbb\giftvoucher\services\VoucherTypesService
     *
     * @author Robin Schambach
     * @since  21.06.2021
     */
    public function getVoucherTypes(): VoucherTypesService
    {
        return $this->get('voucherTypes');
    }

    public function getCodeStorage()
    {
        return $this->get('codeStorage');
    }

    public static function log($message)
    {
        Craft::getLogger()->log($message, Logger::LEVEL_INFO, 'gift-voucher');
    }

    public static function error($message)
    {
        Craft::getLogger()->log($message, Logger::LEVEL_ERROR, 'gift-voucher');
    }


    // Private Methods
    // =========================================================================

    private function _setPluginComponents()
    {
        $settings = $this->getSettings();

        $this->setComponents([
            'codes' => CodesService::class,
            'klaviyoConnect' => KlaviyoConnect::class,
            'pdf' => PdfService::class,
            'redemptions' => RedemptionsService::class,
            'vouchers' => VouchersService::class,
            'voucherTypes' => VoucherTypesService::class,
            'codeStorage' => $settings->codeStorage,
        ]);

        BaseHelper::registerModule();
    }

    private function _setLogging()
    {
        BaseHelper::setFileLogging('gift-voucher');
    }

}
