<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Weather Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
       <div class="container">
        <h1>Weather Data</h1>
        <br>
        <br>
        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th>City</th>
                    <th>Coordinates</th>
                    <th>Weather Condition</th>
                    <th>Temperature (°C)</th>
                    <th>Feels Like (°C)</th>
                    <th>Humidity</th>
                    <th>Wind Speed (km/h)</th>
                    <th>Date and Time</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $weatherData)
                <tr>
                    <td>{{ $weatherData['name'] }}</td>
                    <td>{{ $weatherData['coord']['lat'] }}, {{ $weatherData['coord']['lon'] }}</td>
                    <td>{{ $weatherData['weather'][0]['main'] }}</td>
                    <td>{{ $weatherData['main']['temp'] }}</td>
                    <td>{{ $weatherData['main']['feels_like'] }}</td>
                    <td>{{ $weatherData['main']['humidity'] }}</td>
                    <td>{{ $weatherData['wind']['speed'] }}</td>
                    <?php $timezoneOffset = $weatherData['timezone'];
                    $timezoneOffsetMinutes = $timezoneOffset / 60;
                    $currentDateTime = now()->addMinutes($timezoneOffsetMinutes); ?>
                    <td>{{ $currentDateTime->format('Y-m-d H:i:s'); }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
<br>
<br>
<h1>User Data</h1>
<br>
<table class="table">
    <thead>
        <tr>
            <th>1</th>
            <th>Username</th>
            <th>email</th>
            <th>Joined Date</th>
      
        </tr>
    </thead>
    <tbody>
        <?php $i= 1; ?>
        @foreach ($users as $user)
        <tr>
            <td>{{ $i++; }}</td>
            <td>{{ $user['name'] }}</td>
            <td>{{ $user['email'] }}</td>
            <td>{{ $user['created_at'] }}</td>
          
        </tr>
        @endforeach
    </tbody>
</table>



    </div>
    </div>
</x-app-layout>
