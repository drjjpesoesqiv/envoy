<?php

namespace jpeso\Envoy\Controller\Index;

class Index extends \Magento\Framework\App\Action\Action
{
  protected $cart;
  protected $scopeConfig;
  protected $timeout;

  public function __construct(
    \Magento\Framework\App\Action\Context $context,
    \Magento\Checkout\Model\Cart $cart,
    \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
  ) {
    $this->cart = $cart;
    $this->scopeConfig = $scopeConfig;

    $this->timeout = $this->scopeConfig->getValue(
      'envoy/general/timeout',
      \Magento\Store\Model\ScopeInterface::SCOPE_STORE
    );

    parent::__construct($context);
  }

  public function execute()
  {
    try
    {
      $request = $this->getRequest()->getParam('request');
      $decoded = json_decode(base64_decode($request));

      if ( ! $decoded || empty($decoded->p) || empty($decoded->t))
        throw new \Exception('Invalid request');

      if (time() - $decoded->t > $this->timeout)
        throw new \Exception('Referrer link has timed out');

      $this->cart->addProductsByIds($decoded->p)->save();
    }
    catch (\Exception $e)
    {
      $this->messageManager->addError(__($e->getMessage()));
    }

    $resultRedirect = $this->resultRedirectFactory->create();
    $resultRedirect->setPath('checkout/cart/index');

    return $resultRedirect;
  }
}
