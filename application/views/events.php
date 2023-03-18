<?php 
    function time_converter($data)
    {
        $am_pm = "AM";
        $hour = number_format(substr($data, 0, 2));
        $minute = substr($data, 2, );
        if ($hour > 12)
        {
            $hour = $hour - 12;
            $am_pm = "PM";
        }
        return $hour.$minute.$am_pm;
    }
?>
<div>
    <main class="about-main">
        <div class="header-children-homes pl-5 pt-5 header-about-blog" style="width: 100%">
            <div class="text-left mt-5 p-2 ">
                <h1 class="text-left">Upcoming Events</h1>
            </div>
        </div>
        <?php 

            foreach ($events['all_data'] as $key => $value) {
                echo '<div class="p-4">
                <div class="event">
                    <h2>'.$value->name.'</h2>
                    <p>Date: <span class="date">'.$value->date.'</span></p>
                    <p>Location: <span class="location">'.$value->location.'</span></p>
                    <p>Time: <span class="location">'.time_converter($value->time).'</span></p>
                    <p>Description: <span class="description">'.$value->description.'</span></p>
                </div>
            </div>';
            }
        
            
        ?>
    </main>
</div>