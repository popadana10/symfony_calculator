<?php
// src/Controller/CalculatorController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class CalculatorController extends AbstractController
{
    #[Route('/calculator', name: 'app_calculator')]
    public function calculate(Request $request): Response
    {
        $result = null;
        $num1 = $request->query->get('num1');
        $num2 = $request->query->get('num2');
        $operation = $request->query->get('operation');

        if ($num1 !== null && $num2 !== null && $operation !== null) {
            switch ($operation) {
                case 'add':
                    $result = $num1 + $num2;
                    break;
                case 'subtract':
                    $result = $num1 - $num2;
                    break;
                case 'multiply':
                    $result = $num1 * $num2;
                    break;
                case 'divide':
                    $result = $num2 != 0 ? $num1 / $num2 : 'Cannot divide by zero';
                    break;
                default:
                    $result = 'Invalid operation';
            }

            $num1 = null;
            $num2 = null;
            $operation = null;
        }
        return $this->render('calculator/index.html.twig', [
            'result' => $result,
            'num1' => $num1,
            'num2' => $num2,
            'operation' => $operation
        ]);
    }
}
