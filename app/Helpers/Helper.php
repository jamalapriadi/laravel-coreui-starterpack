<?php
    function imageUrl($path, $width = NULL, $height = NULL,$quality=NULL,$crop=NULL) {
        if(!$width && !$height) {
            $url = env(‘IMAGE_URL’) . $path;
        } else {
            $url = url('/') . '/timthumb.php?src=' . env('IMAGE_URL') . $path;
            if(isset($width)) {
                $url .= '&w=' . $width; 
            }
            if(isset($height) && $height>0) {
                $url .= '&h=' .$height;
            }
            if(isset($crop))
            {
                $url .= "&zc=".$crop;
            }
            else
            {
                $url .= "&zc=1";
            }
            if(isset($quality))
            {
                $url .='&q='.$quality.'&s=1';
            }
            else
            {
                $url .='&q=95&s=1';
            }
        }
    
        return $url;
    }

    function periode($date1,$date2){
        if($date1>$date2){
            $per1=$date2;
            $per2=$date1;
        } else {
            $per1=$date1;
            $per2=$date2;
        }
    
        $dper1= date("d", strtotime($per1));
        $Mper1= date("M", strtotime($per1));
        $Yper1= date("Y", strtotime($per1));
        $dMYper1= date("d M Y", strtotime($per1));
        $dMper1= date("d M", strtotime($per1));
        $dper2= date("d", strtotime($per2));
        $Mper2= date("M", strtotime($per2));
        $Yper2= date("Y", strtotime($per2));
        $dMYper2= date("d M Y", strtotime($per2));
        if ($Yper1!=$Yper2){
            return $dMYper1."-".$dMYper2;
        } else {
            if($Mper1!=$Mper2){
                return $dMper1."-".$dMYper2;
            } else {
                if($dper1!=$dper2){
                    return $dper1."-".$dMYper2;
                } else {
                    return $dMYper2;
                }
            }
        }
    }
?>