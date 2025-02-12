<?php

namespace App\Controllers;
use App\Models\UserModel;

class UserController extends BaseController{


    //  that below code for sign up for user -----------------------------

    public function signup(){
        return view('signup');
    }

    public function signup_action(){

        $userModel = new UserModel();

        $rules =[
            'username' => 'required|min_length[3]|max_length[20]',
            'mobile'   => 'required|numeric',
            'email'    => 'required|valid_email',
            'password' => 'required|min_length[8]',
        ];

        if(!$this->validate($rules)){
            // $data['validation'] = $this->validator;

            $response = [
                'validation_errors' => $this->validator->getErrors()
            ];
            return $this->response->setJSON($response);
        }else{

          
    
            $username = $this->request->getPost('username');
            $mobile = $this->request->getPost('mobile');
            $email = $this->request->getPost('email');
            $password = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);

           $existingUser =  $userModel->where('email',$email);

           if($existingUser){
                $response = ['error' => "Email already exists. Please use a different email."];
                return $this->response->setJSON($response);

           }
    
            $user_data = [
                'name' => $username,
                'mobile' => $mobile,
                'email' => $email,
                'password' => $password,
            ];
    
            $insertID = $userModel->insert($user_data);
            $data = [];
            if ($insertID) {
                $response = ['success' => "Data successfully saved!"];
            } else {
                $response = ['error' => "There was an error saving your data. Please try again."];
            }

            return $this->response->setJSON($response);

        }


        return view('/signup');

        // return redirect()->to('/login');


    }

    //  that below code for login authentication ----------------------------


    public function login(){
        return view('/login');
    }


    public function login_action(){
        $userModel = new UserModel();

        $username = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $userModel->where('email',$username)->first();
        if($user){
            if(password_verify($password,$user['password'])){
                session()->set([
                    'user_id' => $user['id'],
                    'username' => $user['name'],
                    'logged_in' => true,
                ]);

                return redirect()->to('/dashboard');
            }else{
                session()->setFlashdata('error','Invalid Password');
                return redirect()->back();
            }
        }

    }


    // public function dashboard(){

    //     if(!session()->get('logged_in')){
    //         return redirect()->to('/login');
    //     }else{
    //         return view('/dashboard');
    //     }
    // }


    public function logout(){
        session()->destroy();
        return redirect()->to('/login');
    }


}


?>