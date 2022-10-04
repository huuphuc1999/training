<?php
/**
 * Traits
 *
 * PHP version 7
 *
 * @category  Traits
 * @package   App
 * @author    Phuc <phan.phuc.rcvn2012@gmail.com>
 * @copyright 2016 CriverCrane! Corporation. All Rights Reserved.
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      http://localhost/
 */
namespace App\Http\Traits;

use Symfony\Component\HttpFoundation\Response;
/**
 * Handle repetitive tasks
 *
 * @category  Traits
 * @package   App
 * @author    Phuc <phan.phuc.rcvn2012@gmail.com>
 * @copyright 2016 CriverCrane! Corporation. All Rights Reserved.
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      http://localhost/
 */
trait ApiResponse
{
    /**
     * Returns a response if processing is successful
     *
     * @param $data    return an object
     * @param $message return a message
     *
     * @return \Illuminate\Http\Response
     */
    public function successResponce($data = [], $message = "success")
    {
        return response()->json(
            [
                'code' => 200,
                'data' => $data,
                "name" => "Successfully",
                "type" => "RESPONSE_OK",
                "message" => $message,
            ], Response::HTTP_OK
        );
    }
    /**
     * Returns a response if processing failed
     *
     * @param $message return a message
     *
     * @return \Illuminate\Http\Response
     */
    public function errorsResponce($message = "false")
    {
        return response()->json(
            [
                'code' => 200,
                "name" => "Handling failure",
                "type" => "RESPONSE_FALSE",
                "message" => $message,
            ], Response::HTTP_INTERNAL_SERVER_ERROR
        );
    }
}
