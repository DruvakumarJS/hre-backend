<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\User;
use App\Models\Attendance ; 

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
         
        $schedule->call(function () {

            $Users = User::where('isloggedin', '1')->get();

            foreach ($Users as $key => $value) {

                if(Attendance::where('user_id', $value->id)->where('date', date('Y-m-d'))->exists()){
                    $login = Attendance::where('user_id', $value->id)->where('date', date('Y-m-d'))->first();

                    $l_in = $login->date." ".$login->login_time;

                    $l_out = date('Y-m-d')." ".'17:00';
                    $logintime = strtotime($l_in) ;
                    $logouttime = strtotime($l_out);

                    $total_hour = $logouttime - $logintime ; 

                     $update_attendeance  = Attendance::where('user_id', $value->id)->where('date', date('Y-m-d'))
                        ->update([
                            'logout_time' => '17:00' ,
                            'logout_lat' => '0.0' ,
                            'logout_long' => '0.0' ,
                            'logout_location' => 'Bangalore',
                            'total_hours' => $total_hour/60
                        ]);

                  if($update_attendeance){
                         $updateUser = User::where('id' , $value->id)->update([
                                'isloggedin' => '0' 
                            ]);
                  }

               

                }
               
            }
 
        })->everyMinute()
      //  $schedule->command('inspire')->everyMinute()

          ->before(function () {
            // print_r("before");
         })
         ->after(function () {
            // print_r("After");
         })
        
          ->onSuccess(function () {
            // Mail::to('druva@netiapps.com')->send(new TestEmail());
            // print_r("started");
         })
         ->onFailure(function () {
            // print_r("Failed to start");
              
         });
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
