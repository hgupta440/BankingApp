<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class transactionTest extends TestCase
{

    /**
     * A test for login User.
     *
     * @return void
     */
    public function test_Login()
    {
        $user = User::factory()->create([
            'password' => bcrypt($password = '12345678'),
        ]);

        $response = $this->post('/authenticate', [
            'email' => $user->email,
            'password' => "invalid-password",
        ]);

        $response->assertRedirect('/');
    

        $user = User::factory()->create([
            'password' => bcrypt($password = '12345678'),
        ]);

        $response = $this->post('/authenticate', [
            'email' => $user->email,
            'password' => $password,
        ]);

        $response->assertRedirect('/dashboard');
       


    } 

     /**
     * A test for Deposite.
     *
     * @return void
     */
    public function test_Deposit()
    {
        $user = User::latest()->first();
        $this->actingAs($user);

        // success deposite
        $response = $this->post('/deposit', [
            'amount' => "1000"
        ]);
        $response->assertSessionHasNoErrors();

        // error for empty deposite
        $response = $this->post('/deposit', [
            'amount' => ""
        ]);        
        $response->assertSessionHasErrors();
        
        // error for non numeric deposite
        $response = $this->post('/deposit', [
            'amount' => "test non numeric"
        ]);
        $response->assertSessionHasErrors();
    } 


     /**
     * A test for Withdraw .
     *
     * @return void
     */
    public function test_Withdraw()
    {
        $user = User::latest()->first();
        $this->actingAs($user);

        // success for withdraw
        $response = $this->post('/withdraw', [
            'amount' => "100"
        ]);
        $response->assertSessionHasNoErrors();

        // error for empty withdraw
        $response = $this->post('/withdraw', [
            'amount' =>  ''
        ]);        
        $response->assertSessionHasErrors();
        
        
        // error for non numeric withdraw
        $response = $this->post('/withdraw', [
            'amount' => "test non numeric"
        ]);
        $response->assertSessionHasErrors();

        // error for high withdraw
        $response = $this->post('/withdraw', [
            'amount' => "2000"
        ]);
        $response->assertSessionHasErrors();
    } 


    /**
     * A test for Withdraw .
     *
     * @return void
     */
    public function test_Transfer()
    {
        $user = User::latest()->get();
        $userFirst = $user[0];
        $userNext = $user[1];

        $this->actingAs($userFirst);

        // error for sucess for transfer
        $response = $this->post('/transfer', [
            'amount' => "100",
            'email' => $userNext->email
        ]);
        $response->assertSessionHasNoErrors();

        // error for self transfer
        $response = $this->post('/transfer', [
            'amount' =>  '100',
            'email' => $userFirst->email
        ]);        
        $response->assertSessionHasErrors();


        // error for not exist user transfer
        $response = $this->post('/transfer', [
            'amount' =>  '100',
            'email' => "test@test.com"
        ]);        
        $response->assertSessionHasErrors();        
        
        // error for nn numeric transfer
        $response = $this->post('/transfer', [
            'amount' => "test non numeric",
            'email' => $userNext->email
        ]);
        $response->assertSessionHasErrors();

        // error for high transfer
        $response = $this->post('/transfer', [
            'amount' => "2000",
            'email' => $userNext->email
        ]);
        $response->assertSessionHasErrors();

        // error for empty transfer
        $response = $this->post('/transfer', [
            'amount' => "",
            'email' => $userNext->email
        ]);
        $response->assertSessionHasErrors();
    }
   
}
