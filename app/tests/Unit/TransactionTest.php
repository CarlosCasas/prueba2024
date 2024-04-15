<?php

use PHPUnit\Framework\TestCase;

require_once 'TransactionController.php';

class TransactionTest extends TestCase
{
    // Método de prueba para probar el caso de éxito de la creación de una transacción
    public function testCreateTransactionSuccess()
    {
        // Simulación de datos de solicitud
        $_POST['payer'] = 1;
        $_POST['payee'] = 2;
        $_POST['value'] = 100;

        // Creación de una instancia de TransactionController
        $transactionController = new TransactionController();

        // Ejecución del método createTransaction
        $response = $transactionController->createTransaction();

        // Verificación de que la transacción se ha creado con éxito
        $responseBody = json_decode(ob_get_contents(), true);
        
        // Verificación del código de estado en la respuesta
        $this->assertEquals(201, http_response_code());

        // Verificación del cuerpo del mensaje JSON en la respuesta
        $responseBody = json_decode(ob_get_contents(), true);
        $this->assertArrayHasKey('transaction_id', $responseBody);
        $this->assertArrayHasKey('userPayerId', $responseBody);
        $this->assertArrayHasKey('notification', $responseBody);
        // Otros aserciones si es necesario
    }

    // Método de prueba para probar el manejo de errores al crear una transacción
    public function testCreateTransactionError()
    {
        // Simulación de datos de solicitud incorrectos
        $_POST['payer'] = 1;
        $_POST['payee'] = 20; // ID de usuario que no existe
        $_POST['value'] = 100;

        // Creación de una instancia de TransactionController
        $transactionController = new TransactionController();

        // Ejecución del método createTransaction
        $response = $transactionController->createTransaction();

        // Verificación del código de estado en la respuesta
        $this->assertEquals(500, http_response_code());

        // Verificación del cuerpo del mensaje JSON en la respuesta
        $responseData = json_decode(ob_get_contents(), true);
        $this->assertArrayHasKey('error', $responseData);
    }

    // Otros métodos de prueba para otros casos de uso
}
