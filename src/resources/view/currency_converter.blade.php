<!DOCTYPE html>
<html>
<head>
    <title>Currency Converter</title>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <link href="{{url('vendor/converter/styles.css')}}" type="text/css" rel="stylesheet">
    <script src="{{url('vendor/converter/jquery-min.js')}}" type="text/javascript"></script>
    <script src="{{url('vendor/converter/app.js')}}" type="text/javascript"></script>

</head>
<body>      
<div class="container">
    <div class="content">

        @if($errors->has())
            We encountered the following errors:
            <ul>
                @foreach($errors->all() as $message)

                    <li>{{ $message }}</li>

                @endforeach
            </ul>
        @endif

        {{ Form::open(['url' => 'converter', 'id' => 'covert-form']) }}
        <div><span class="error-amount"></span></div>
        <label>Amount</label>
        <input type="text" name="amount" value="{{ ($amount ? $amount : '') }}">
        <br>

        <div><span class="error-currency"></span></div>
        <label>Convert from</label>
        {{ Form::select(
        'source_currency',
        $currencyData,
         $sourceCurrencyAmout,
         ['id' => 'source-currency']
         ) }}
        <input type="hidden" name="source_currency_val">
        <input type="hidden" name="source_currency_amount">
        <br>
        <label>Convert to</label>
        {{ Form::select(
        'target_currency',
         $currencyData,
         $targetCurrencyAmout,
         ['id' => 'target-currency']
         ) }}
        <input type="hidden" name="target_currency_val">
        <input type="hidden" name="target_currency_amount">
        <br>
        <button>Submit</button>
        {{ Form::close() }}

        @if($targetCurrencyConverted && $sourceCurrencyVal
        && $targetCurrencyVal && $amount )
            <div class="converter">
                <h3>{{$amount}} {{$sourceCurrencyVal}} = {{$targetCurrencyConverted}} {{$targetCurrencyVal}}</h3>
            </div>
        @endif
    </div>
</div>
</body>
</html>
