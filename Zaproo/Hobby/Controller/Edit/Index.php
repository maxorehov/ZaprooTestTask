<?php
declare(strict_types=1);

namespace Zaproo\Hobby\Controller\Edit;

use Magento\Framework\App\ActionInterface;
use Magento\Framework\View\Result\PageFactory;
use Magento\Customer\Model\Session;

class Index implements ActionInterface
{
    /**
     * @var Session
     */
    private $session;

    /**
     * @var PageFactory
     */
    private $pageFactory;

    /**
     * @param PageFactory $pageFactory
     */
    public function __construct(PageFactory $pageFactory, Session $session)
    {
        $this->pageFactory = $pageFactory;
        $this->session = $session;
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        if ($this->session->isLoggedIn()) {
            return $this->pageFactory->create();
        }
    }
}
