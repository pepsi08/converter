<!DOCTYPE html>
<html>
<head>
    <title>Currency Converter</title>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <script src="{{url('/js')}}/jquery-min.js" type="text/javascript"></script>
    <script src="{{url('/js')}}/app.js" type="text/javascript"></script>
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

        @if($targetCurrencyConverted && $sourceCurrencyVal
        && $targetCurrencyVal && $amount )
            <div class="converter">
                <h3>{{$amount}} {{$sourceCurrencyVal}} = {{$targetCurrencyConverted}} {{$targetCurrencyVal}}</h3>
            </div>
        @endif

        {{ Form::open(['url' => 'converter', 'id' => 'covert-form']) }}
        <div><span class="error-amount"></span></div>
        <label>Amount</label>
        <br>
        <input type="text" name="amount" value="{{ ($amount ? $amount : '') }}">
        <br>

        <div><span class="error-currency"></span></div>
        <label>Convert from</label>
        <br>
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
        <br>
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
    </div>
</div>
</body>
</html>
