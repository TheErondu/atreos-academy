<?php
use App\Models\Quote;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class QuotesHelper
{


    public function getQuotes()
    {
        // Check if quotes are already cached
        if (!Cache::has('quotes')) {
            // Fetch quotes from the API
            $quotes = $this->fetchAndSaveQuotes();
        } else {
            // Retrieve quotes from the cache
            $quotes = Cache::get('quotes');
        }
        // Cache the quotes array for a day
        Cache::put('quotes', $quotes, now()->addHours(5));
    }

    private function fetchAndSaveQuotes()
    {
        $quotes = [];

        // Specify the category
        $category = 'education';

        try {
            // Make the API request using Guzzle HTTP client
            $response = Http::withHeaders([
                'X-Api-Key' => 'eksmmd+/4dhnNbiJWWtZHw==H64P8En010RVvV4D',
            ])->get('https://api.api-ninjas.com/v1/quotes?category=' . $category);

            // Check if the request was successful
            if ($response->successful()) {
                // Decode the JSON response
                $apiQuotes = $response->json();

                foreach ($apiQuotes as $apiQuote) {
                    // Save each quote to the database
                    Quote::firstOrCreate(
                        ['quote' => $apiQuote['quote']],
                        [
                            'quote' => $apiQuote['quote'],
                            'author' => $apiQuote['author'],
                            'category' => $apiQuote['category'],
                        ]
                    );

                    // Add the quote to the array
                    $quotes[] = $apiQuote['quote'];
                }

            } else {
                // Log and handle the error if the request was not successful
                \Log::error('API request error: ' . $response->status());
                $quotes = Quote::inRandomOrder();
            }
        } catch (Exception $e) {
            \Log::error('error:' . $e);
        }

        return $quotes;
    }
}
