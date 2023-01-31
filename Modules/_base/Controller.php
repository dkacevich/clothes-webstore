<?php

namespace Modules\_base;

use System\Template;

class Controller {
    protected Template $view;
    protected array $pageContent;

    public function __construct() {
        $this->view = Template::getInstance();
        $this->pageContent  = [
            'title' => 'Fashion',
            'content' => '',
            'jquery' => false,
            'currentUrl' => BASE_URL . explode('?', $_SERVER['REQUEST_URI'])[0],
            'cartCount' =>  $this->countCart(),
        ];
    }

    protected function countCart(): int {
        $count = 0;

        if (isset($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $id => $product) {
                if (is_int($id)) {
                    $count += $product['qty'];
                }
            }
        }
        
        return $count;
    }

    public function render() {
        return $this->view->render('_base/Views/v_main.twig', $this->pageContent);
    }
}
