<?php

namespace Ivanchenko\Converter\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Ivanchenko\Converter\Http\Requests\CurrencyRequest;

class CurrencyController extends Controller
{

    /**
     * Convert currencies handler
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $targetCurrencyConverted = '';
        $amount = $request->request->get('amount', '');

        $sourceCurrencyVal = $request->request->get(
            'source_currency_val',
            ''
        );
        $targetCurrencyVal = $request->request->get('target_currency_val', '');
        $sourceCurrencyAmout = $request->request->get(
            'source_currency_amount',
            ''
        );
        $targetCurrencyAmout = $request->request->get(
            'target_currency_amount',
            ''
        );

        if ($request->isMethod('POST')) {
            //Calculate converting
            $sourceEuro = $amount / $sourceCurrencyAmout;
            $targetCurrencyConverted = number_format(
                (float)($sourceEuro * $targetCurrencyAmout),
                4,
                '.',
                '');
        }
        $xml = simplexml_load_file(
            'http://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml'
        );

        $currencyData = [];
        foreach ($xml->Cube->Cube->children() as $key => $cube) {
            $cube = (array)$cube;
            $currencyData[$cube['@attributes']['rate']] = $cube['@attributes']['currency'];
        }

        return view('converter::currency_converter', [
            'currencyData' => $currencyData,
            'amount' => $amount,
            'sourceCurrencyVal' => $sourceCurrencyVal,
            'sourceCurrencyAmout' => $sourceCurrencyAmout,
            'targetCurrencyVal' => $targetCurrencyVal,
            'targetCurrencyAmout' => $targetCurrencyAmout,
            'targetCurrencyConverted' => $targetCurrencyConverted,
        ]);
    }

    /**
     * Validate currencies data sent by AJAX
     *
     * @param CurrencyRequest $request
     */
    public function validateCurrency(CurrencyRequest $request)
    {
    }
}