<?php

/**
 * attendanceregister_tracked_users.class.php - Class containing Attendance Register's tracked Users and their summaries
 *
 * @package    mod
 * @subpackage attendanceregister
 * @version $Id
 * @author Lorenzo Nicora <fad@nicus.it>
 *
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Holds all tracked Users of an Attendance Register
 *
 * Implements method to return html_table to render it.
 *
 * @author nicus
 */
class attendanceregister_tracked_users {

    /**
     * Array of User
     */
    public $users;

    /**
     * Array if attendanceregister_user_aggregates_summary
     * keyed by $userId
     */
    public $usersSummaryAggregates;


    /**
     * Instance of attendanceregister_tracked_courses
     * containing all tracked Courses
     * @var type
     */
    public $trackedCourses;

    /**
     * Ref. to AttendanceRegister instance
     */
    private $register;

    /**
     * Ref to mod_attendanceregister_user_capablities instance
     */
    private $userCapabilites;
    
    private $dateInterval;


    /**
     * Constructor
     * Load all tracked User's and their summaris
     * Load list of tracked Courses
     * @param object $register
     * @param attendanceregister_user_capablities $userCapabilities
     */
    function __construct($register, attendanceregister_user_capablities $userCapabilities) {
        $this->register = $register;
        $this->userCapabilities = $userCapabilities;
        $this->users = attendanceregister_get_tracked_users($register);
        $this->trackedCourses = new attendanceregister_tracked_courses($register);
        //$this->dateInterval = $dateInterval;

        $trackedUsersIds = attendanceregister__extract_property($this->users, 'id');

        // Retrieve Aggregates summaries
        $aggregates = attendanceregister__get_all_users_aggregate_summaries($register);
        // Remap in an array of attendanceregister_user_aggregates_summary, mapped by userId
        $this->usersSummaryAggregates = array();
        foreach ($aggregates as $aggregate) {
            // Retain only tracked users
            if ( in_array( $aggregate->userid, $trackedUsersIds) ) {
                // Create User's attendanceregister_user_aggregates_summary instance if not exists
                if ( !isset( $this->usersSummaryAggregates[ $aggregate->userid ] )) {
                    $this->usersSummaryAggregates[ $aggregate->userid ] = new attendanceregister_user_aggregates_summary();
                }
                // Populate attendanceregister_user_aggregates_summary fields
                if( $aggregate->grandtotal ) {
                    $this->usersSummaryAggregates[ $aggregate->userid ]->grandTotalDuration = $aggregate->duration;
                    $this->usersSummaryAggregates[ $aggregate->userid ]->lastSassionLogout = $aggregate->lastsessionlogout;
                } else if ( $aggregate->total && $aggregate->onlinesess == 1 ) {
                $this->usersSummaryAggregates[ $aggregate->userid ]->onlineTotalDuration = $aggregate->duration;
                } else if ( $aggregate->total && $aggregate->onlinesess == 0 ) {
                    $this->usersSummaryAggregates[ $aggregate->userid ]->offlineTotalDuration = $aggregate->duration;
                }
            }
        }
    }

    /**
     * Build the html_table object to represent details
     * @return html_table
     */
    public function html_table() {
        global $OUTPUT, $doShowPrintableVersion,$DB;

        $strNotAvail = get_string('notavailable');
        //$beginDate = 1525104000;

        $table = new html_table();
        $table->attributes['class'] .= ' attendanceregister_userlist table table-condensed table-bordered table-striped table-hover';

        /// Header
        /*
        $rowcount = 0 ;
        if($this->users)
        {
            foreach($this->users as $user)
            {
                $rowcount++;
                
                $userAggregate = null;
                if ( isset( $this->usersSummaryAggregates[$user->id] ) ) {
                    $userAggregate = $this->usersSummaryAggregates[$user->id];
                }
                
                //$this->userCapabilites->isTracked = true;
                
                $thisUserSessions = new attendanceregister_user_sessions($this->register,$user->id,$this->userCapabilities);
                $thisUserSessions->set_Users($user);
                $table = $thisUserSessions->html_table();
            }
        }*/
        //$fullnameWithLink = '<a href="' . $linkUrl . '">' . fullname($user) . '</a>';

        $result = $DB->get_record_sql('SELECT * FROM {attendanceregister} Where id = ?',array($this->register->id));
        
        $beginDate = $result->begindate;
        $beginDateStr = date('y-m-d',$beginDate);
        $beginDateInt = strtotime($beginDateStr);
        $dateToday = date('y-m-d', time());
        $dateTodayint = strtotime($dateToday);
        
        $this->dateInterval = $result->submitinterval;
        
        $strDayback1 = '-' . (string)$this->dateInterval . ' days';
        $strDayback2 = '-' . (string)$this->dateInterval * 2 . ' days';
        $strDayback3 = '-' . (string)$this->dateInterval * 3 . ' days';
        $strDayback4 = '-' . (string)$this->dateInterval * 4 . ' days';
        $strDayback5 = '-' . (string)$this->dateInterval * 5 . ' days';
        $strDayback6 = '-' . (string)$this->dateInterval * 6 . ' days';
        $strDayback7 = '-' . (string)$this->dateInterval * 7 . ' days';
        
        $datefirstint = $beginDateInt+(3600*24*($this->dateInterval-1))+(($dateTodayint-$beginDateInt)/(3600*24*$this->dateInterval))*3600*24*$this->dateInterval;
        $datefiestTomorrow = $datefirstint + 3600*24;
        $date0 = date('m-d', $datefirstint);
        
        //$date0 = date('y-m-d',strtotime($datefirst));
        
        
        $date1 = date('m-d', strtotime($strDayback1,$datefirstint));
        $date2 = date('m-d', strtotime($strDayback2,$datefirstint));
        $date3 = date('m-d', strtotime($strDayback3,$datefirstint));
        $date4 = date('m-d', strtotime($strDayback4,$datefirstint));
        $date5 = date('m-d', strtotime($strDayback5,$datefirstint));
        $date6 = date('m-d', strtotime($strDayback6,$datefirstint));
        $date7 = date('m-d', strtotime($strDayback7,$datefirstint));
        
        date('m-d', strtotime('+1 day',strtotime($strDayback1,$datefirstint)));
       
        $dateStr0 = date('m-d', strtotime('+1 day',strtotime($strDayback1,$datefirstint)))."__".$date0;
        $dateStr1 = date('m-d', strtotime('+1 day',strtotime($strDayback2,$datefirstint))).'__'.$date1;
        $dateStr2 = date('m-d', strtotime('+1 day',strtotime($strDayback3,$datefirstint))).'__'.$date2;
        $dateStr3 = date('m-d', strtotime('+1 day',strtotime($strDayback4,$datefirstint))).'__'.$date3;
        $dateStr4 = date('m-d', strtotime('+1 day',strtotime($strDayback5,$datefirstint))).'__'.$date4;
        $dateStr5 = date('m-d', strtotime('+1 day',strtotime($strDayback6,$datefirstint))).'__'.$date5;
        $dateStr6 = date('m-d', strtotime('+1 day',strtotime($strDayback7,$datefirstint))).'__'.$date6;
        
        if($this->dateInterval == 1)
        {
            $dateStr0 = $date0;
            $dateStr1 = $date1;
            $dateStr2 = $date2;
            $dateStr3 = $date3;
            $dateStr4 = $date4;
            $dateStr5 = $date5;
            $dateStr6 = $date6;
        }
        
        $table->head = array(
            get_string('count', 'attendanceregister'),
            get_string('fullname', 'attendanceregister'),
            
            $dateStr0,
            $dateStr1,
            $dateStr2,
            $dateStr3,
            $dateStr4,
            $dateStr5,
            $dateStr6,
            
        );
        $table->align = array(  'left',
                                'center',
                                'left',
                                'left',
                                'left',
                                'left',
                                'left',
                                'left',
                                'left',    );
        
        
        

        if ( $this->register->offlinesessions ) {
            $table->head[] = get_string('total_time_offline', 'attendanceregister');
            $table->align[] = 'center';
            //$table->head[] = get_string('grandtotal_time', 'attendanceregister');
            //$table->align[] = 'right';
        }

        $table->head[] = get_string('last_session_logout', 'attendanceregister');
        $table->align[] = 'center';


        /// Table Rows

        if( $this->users ) {
            $rowcount = 0;
            foreach ($this->users as $user) {
                $rowcount++;

                $userAggregate = null;
                if ( isset( $this->usersSummaryAggregates[$user->id] ) ) {
                    $userAggregate = $this->usersSummaryAggregates[$user->id];
                }

                // Basic columns
                $linkUrl = attendanceregister_makeUrl($this->register, $user->id);
                $fullnameWithLink = '<a href="' . $linkUrl . '">' . fullname($user) . '</a>';
                //$onlineDuration = ($userAggregate)?( $userAggregate->onlineTotalDuration ):( null );
                //$onlineDurationStr =  attendanceregister_format_duration($onlineDuration );
                //$tableRow = new html_table_row( array( $rowcount, $fullnameWithLink ) );

                // Add class for zebra stripes
                //$tableRow->attributes['class'] .= (  ($rowcount % 2)?' attendanceregister_oddrow':' attendanceregister_evenrow' );

                // Optional columns
                if ( $this->register->offlinesessions ) {
                    $thisUserSessions = new attendanceregister_user_sessions($this->register,$user->id,$this->userCapabilities);
                    
                    //$strSelect = "name= ".(string) fullname($user);
                   // $inttime = strtotime($date1);
                      
                    //$result = $DB->get_record('attendanceregister', array('course' => 'laojv' ));
                   // $result0 = $DB->get_record_sql(
                   //         'SELECT * FROM {attendanceregister_session} WHERE register = ? AND userid = ? AND login >= ? AND login <= ?', array( $this->register->id, $user->id , strtotime($date1) ,strtotime($date0) ) );
                    
                    
                    $result1 = $DB->get_record_sql(
                            'SELECT * FROM {attendanceregister_session} WHERE register = ? AND userid = ? AND login >= ? AND login < ?', 
                            array( $this->register->id, $user->id , getTomorrow(strtotime($strDayback1,$datefirstint)), strtotime(date('y-m-d', $datefiestTomorrow)) ) );
                    $result2 = $DB->get_record_sql(
                            'SELECT * FROM {attendanceregister_session} WHERE register = ? AND userid = ? AND login >= ? AND login < ?', 
                            array( $this->register->id, $user->id , getTomorrow(strtotime($strDayback2,$datefirstint)) , getTomorrow(strtotime($strDayback1,$datefirstint))) );
                    $result3 = $DB->get_record_sql(
                            'SELECT * FROM {attendanceregister_session} WHERE register = ? AND userid = ? AND login >= ? AND login < ?',
                            array( $this->register->id, $user->id , getTomorrow(strtotime($strDayback3,$datefirstint)) , getTomorrow(strtotime($strDayback2,$datefirstint)) ) );
                    $result4 = $DB->get_record_sql(
                            'SELECT * FROM {attendanceregister_session} WHERE register = ? AND userid = ? AND login >= ? AND login < ?', 
                            array( $this->register->id, $user->id , getTomorrow(strtotime($strDayback4,$datefirstint)) , getTomorrow(strtotime($strDayback3,$datefirstint)) ) );
                    $result5 = $DB->get_record_sql(
                            'SELECT * FROM {attendanceregister_session} WHERE register = ? AND userid = ? AND login >= ? AND login < ?', 
                            array( $this->register->id, $user->id , getTomorrow(strtotime($strDayback5,$datefirstint)) , getTomorrow(strtotime($strDayback4,$datefirstint)) ) );
                    $result6 = $DB->get_record_sql(
                            'SELECT * FROM {attendanceregister_session} WHERE register = ? AND userid = ? AND login >= ? AND login < ?', 
                            array( $this->register->id, $user->id , getTomorrow(strtotime($strDayback6,$datefirstint)) , getTomorrow(strtotime($strDayback5,$datefirstint)) ) );
                    $result7 = $DB->get_record_sql(
                            'SELECT * FROM {attendanceregister_session} WHERE register = ? AND userid = ? AND login >= ? AND login < ?', 
                            array( $this->register->id, $user->id , getTomorrow(strtotime($strDayback7,$datefirstint)) , getTomorrow(strtotime($strDayback6,$datefirstint)) ) );
                    
                    
                    
                    //$offlinecomments = $thisUserSessions->userSessions[$user]->comments;
                    /*foreach ($result as $re) {
                        $timeStr=(string)$result->login;
                        $loginStr = date('y-m-d',$timeStr);
                        if($loginStr = $date1)
                        {
                            $offlinecomments = $re->comments;
                        }
                        else
                        {
                            $offlinecomments = '1';
                        }
                    }
                    //$timeStr=(string)$result->login;
                    //$loginStr = date('y-m-d',$timeStr);*/
                   
                    
                    
                    $offlinecomments1 = $result1->comments;
                    $offlinecomments2 = $result2->comments;
                    $offlinecomments3 = $result3->comments;
                    $offlinecomments4 = $result4->comments;
                    $offlinecomments5 = $result5->comments;
                    $offlinecomments6 = $result6->comments;
                    $offlinecomments7 = $result7->comments;
                    
                    
                    
                    $tableRow = new html_table_row( array(  $rowcount, 
                                                            $fullnameWithLink ,
                                                            $offlinecomments1 ,
                                                            $offlinecomments2 ,
                                                            $offlinecomments3 ,
                                                            $offlinecomments4 ,
                                                            $offlinecomments5 ,
                                                            $offlinecomments6 ,
                                                            $offlinecomments7 ) );
                    //$tableCell = new html_table_cell( $offlinecomments1 );
                    //$tableRow->cells[] = $tableCell;
                    
                    $offlineDuration = ($userAggregate)?($userAggregate->offlineTotalDuration):( null );
                    $offlineDurationStr = attendanceregister_format_duration($offlineDuration);
                    $tableCell = new html_table_cell( $offlineDurationStr );
                    $tableRow->cells[] = $tableCell;

                    //$grandtotalDuration = ($userAggregate)?($userAggregate->grandTotalDuration ):( null );
                    //$grandtotalDurationStr = attendanceregister_format_duration($grandtotalDuration);
                    
                    //$tableCell = new html_table_cell( $grandtotalDurationStr );
                    //$tableRow->cells[] = $tableCell;
                }

                $lastSessionLogoutStr = ($userAggregate)?( attendanceregister__formatDateTime( $userAggregate->lastSassionLogout ) ):( get_string('no_session','attendanceregister') );
                $tableCell = new html_table_cell( $lastSessionLogoutStr );
                 $tableRow->cells[] = $tableCell;

                $table->data[] = $tableRow;
            }
        } else {
            // No User
            $row = new html_table_row();
            $labelCell = new html_table_cell();
            $labelCell->colspan = count($table->head);
            $labelCell->text = get_string('no_tracked_user', 'attendanceregister');
            $row->cells[] = $labelCell;
            $table->data[] = $row;
        }
        /*
         *
         */

        return $table;
    }
}

