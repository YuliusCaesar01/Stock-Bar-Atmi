protected function schedule(Schedule $schedule)
{
    $schedule->call(function () {
        app(\App\Http\Controllers\YourController::class)->recapDailyData();
    })->daily();
}
