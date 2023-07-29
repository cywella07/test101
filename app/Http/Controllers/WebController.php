<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebController extends Controller
{
    public function index()
    {
        $userEditableText = $this->getPersistedText();

        // Process the user-editable text (2c, 2d, 2e, 2f)
        $processedResult = $this->processText($userEditableText);

        return view('index', compact('userEditableText', 'processedResult'));
    }

    public function save(Request $request)
    {
        // Persist the user-editable text after browser restarts
        $this->persistText($request->input('user_editable_text'));
    
        // Process the user-editable text (2c, 2d, 2e, 2f)
        $processedResult = $this->processText($request->input('user_editable_text'));
    
        // Return the processed result as a JSON response
        return response()->json([
            'processed_result' => $processedResult,
        ]);
    }
    

    private function getPersistedText()
    {
        // You can use any method of persistence you prefer, such as database, file, or session.
        // For example, using session:
        return session('user_editable_text', 'Default Text');
    }

    private function persistText($text)
    {
       
        // You can use any method of persistence you prefer, such as database, file, or session.
        // For example, using session:
        session(['user_editable_text' => $text]);
    }

    private function processText($userEditableText)
    {
        
        // Implement the logic to process the user-editable text.
        // You can perform 2c, 2d, 2e, and 2f functionalities here.
        // Return the processed result as an array or JSON.

        // For example, counting the number of characters in the text:
        $characterCount = strlen($userEditableText);

        // Mock response to match the provided example JSON responses
        $mockResponse = [
            "found" => 5,
            "totalNumPages" => 1,
            "pageNum" => 1,
            "results" => [
                [
                    "SEARCHVAL" => $userEditableText,
                ],
            ],
        ];

        // Mock processed URL response
        $processedURLResponse = [
            "objectCount" => 4,
            "uonfd" => 5,
            "uttsomlgeaaPN" => 1,
            "umpgeaN" => 1,
            "utssrle" => [
                ["arrayCount" => 1],
                ["VSRLHECAA" => $this->sortString($userEditableText)],
            ],
        ];

        return [
            'character_count' => $characterCount,
            'mock_response' => $mockResponse,
            'processed_url_response' => $processedURLResponse,
        ];
    }

    private function sortString($string)
    {
        // Descending-sort sequence of all characters of the string
        $characters = str_split($string);
        arsort($characters);
        return implode('', $characters);
    }
}
