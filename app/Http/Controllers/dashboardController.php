<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class dashboardController extends Controller
{
     public function test(Request $request) {
        // Get the Python script path from the .env file
        $scriptPath = env('PUBLISHER_SCRIPT');

        // Extract the 'state' query parameter from the request
        $argument = $request["x"];

        // Ensure the script path and argument are safely escaped for shell command
        $safeScriptPath = escapeshellarg($scriptPath);
        $safeArgument = escapeshellarg($argument);

        // Construct the command
        //$command = "/bin/bash -c 'source /opt/ros/noetic/setup.bash  && source ~/my_ws/devel/setup.bash && rosrun torta_web_control button_pub.py hello'";
        $VAR = 'test';
        $command = "echo $".$VAR;
        // Execute the command
        $result = shell_exec($command);
        return $result;
    }

    public function Get_IP(){
        $command = 'ifconfig enp0s3 | grep "inet " | awk \'{print $2}\'';
        $result = shell_exec($command);
        return $result;
    }

    public function position_test(Request $request) {
        // Get the Python script path from the .env file
        $scriptPath = env('POSITION_SCRIPT');
        $command = env('SHELL_CMD');

        // Extract the 'x', 'y', and 'theta' parameters from the request
        $x = $request['x'];
        $y = $request['y'];
        $theta = $request['theta'];

        // Ensure the script path and arguments are safely escaped for the shell command
        $ScriptPath = escapeshellarg($scriptPath);
        $X = escapeshellarg($x);
        $Y = escapeshellarg($y);
        $Theta = escapeshellarg($theta);

        // Construct the command
        $command = str_replace('$ScriptPath', $scriptPath, $command);
        $command = str_replace('$a', $X, $command);
        $command = str_replace('$b', $Y, $command);
        $command = str_replace('$c', $Theta, $command);
        
        // Execute the command
        $result = shell_exec($command);
        return $result;
    }

    public function velocity_test(Request $request) {
        // Get the Python script path from the .env file
        $scriptPath = env('VELOCITY_SCRIPT');
        $command = env('SHELL_CMD');

        // Extract the 'x', 'y', and 'theta' parameters from the request
        $x = $request['x'];
        $y = $request['y'];
        $theta = $request['theta'];

        // Ensure the script path and arguments are safely escaped for the shell command
        $ScriptPath = escapeshellarg($scriptPath);
        $X = escapeshellarg($x);
        $Y = escapeshellarg($y);
        $Theta = escapeshellarg($theta);

        // Construct the command
        $command = str_replace('$ScriptPath', $scriptPath, $command);
        $command = str_replace('$a', $X, $command);
        $command = str_replace('$b', $Y, $command);
        $command = str_replace('$c', $Theta, $command);

        // Execute the command
        $result = shell_exec($command);
        return $result;
    }

    public function ARM_test(Request $request) {
        // Get the Python script path from the .env file
        $scriptPath = env('ARM_SCRIPT');
        $command = env('SHELL_CMD');

        // Extract the theta1 and theta2' parameters from the request
        $Angle = $request['Angle'];
        $Gripper = $request['Gripper'];

        // Ensure the script path and arguments are safely escaped for the shell command
        $ScriptPath = escapeshellarg($scriptPath);
        $A = escapeshellarg($Angle);
        $G = escapeshellarg($Gripper);

        // Construct the command
        $command = str_replace('$ScriptPath', $scriptPath, $command);
        $command = str_replace('$a', $A, $command);
        $command = str_replace('$b', $G, $command);
        $command = str_replace('$c', "", $command);
        
        // Execute the command
        $result = shell_exec($command);
        return $result;
    }

    public function PID_test(Request $request) {
        // Get the Python script path from the .env file
        $scriptPath = env('PID_SCRIPT');
        $command = env('SHELL_CMD');

        // Extract the 'x', 'y', and 'theta' parameters from the request
        $kp = $request['kp'];
        $ki = $request['ki'];
        $kd = $request['kd'];

        // Ensure the script path and arguments are safely escaped for the shell command
        $ScriptPath = escapeshellarg($scriptPath);
        $KP = escapeshellarg($kp);
        $KI = escapeshellarg($ki);
        $KD = escapeshellarg($kd);

        // Construct the command
        $command = str_replace('$ScriptPath', $scriptPath, $command);
        $command = str_replace('$a', $KP, $command);
        $command = str_replace('$b', $KI, $command);
        $command = str_replace('$c', $KD, $command);
        
        // Execute the command
        $result = shell_exec($command);
        return $result;
    }

    public function AssignTask(Request $request){
        $scriptPath = env('TASK_SCRIPT');
        $command = env('SHELL_CMD');

        $task =  escapeshellarg($request->taskName);

        $command = str_replace('$ScriptPath', $scriptPath, $command);
        $command = str_replace('$a', $task , $command);
        $command = str_replace('$b', "b" , $command);
        $command = str_replace('$c', "c" , $command);

        $sync_cmd = "sync_maps_tasks ".$request->taskName;

        $sync = shell_exec($sync_cmd);
        $result = shell_exec($command);

        return $result;
    }
}
