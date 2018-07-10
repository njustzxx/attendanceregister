<?PHP

$string['modulename'] = '出席记录';
$string['modulenameplural'] = '出席记录';
$string['modulename_help'] = '出席记录可计算用户在在线课程的出席时间并且允许用户记录脱机活动时间<br />根据不同的追踪方式会有不同的统计范围，例如:单一课程或相同类别的课程。<br />
计算在线出席记录是透过统计Moodle平台的日志记录来取得，新的记录则会在用户脱机后由系统进行排程计算。';
$string['pluginname'] = '出席记录';
$string['pluginadministration'] = '出席记录管理';

// Mod instance form
$string['registername'] = '出席记录名称';
$string['registertype'] = '追踪方式';
$string['registertype_help'] = '* _本课程_: 统计范围仅限本门课.<br />
* _相同课程类别的课程_: 统计范围包含与此门课相同课程类别的课程.<br />
* _透过元课程连结的课程_: 统计范围包含透过元课程连结的课程.
    ';
$string['sessiontimeout'] = '逾时时间';
$string['sessiontimeout_help'] = '逾时时间的设定主要是想知道使用者是否还持续在在线，侦测方式是利用平台日志来<b>推算</b>。使用者在平台上的任何一个动作都会产日志，
藉由日志记录来推算当时用户是否还持续在在线，若二条日志之间的时间大于逾时时间，则判断使用者已不在在线，当次的出席记录只会增加逾时时间的一半。<br />
若逾时时间设定过长则出席时间会被高估，若时间过短则容易出现逾时情况。';

$string['offline_sessions_certification'] = '脱机活动记录';
$string['enable_offline_sessions_certification'] = '开启脱机活动记录';
$string['offline_sessions_certification_help'] = '这是一种<i>自我认证</i>的记录，只有用户本人才能新增。';
$string['dayscertificable'] = '有效时间';
$string['dayscertificable_help'] = '限制脱机活动记录最早可记录的时间，若时间比这个数字还早则无法记录';
$string['submitinterval'] = '间隔时间';
$string['submitinterval_help'] = '学生每隔这段时间就需要上传一次学习记录';
$string['begindate'] = '活动开始日期';
$string['offlinecomments'] = '填写脱机活动的内容';
$string['offlinecomments_help'] = '可让使用者填写脱机活动的内容';
$string['mandatory_offline_sessions_comments'] = '强制使用者填写脱机活动的内容';
$string['offlinespecifycourse'] = '允许针对脱机活动记录指定课程';
$string['offlinespecifycourse_help'] = '允许新增脱机活动记录时指定课程，此选项适用在追踪模式为：相同课程类别或透过元课程连结的课程。';
$string['mandatoryofflinespecifycourse'] = '强制指定课程';
$string['mandatoryofflinespecifycourse_help'] = '强制指定脱机活动记录所隶属的课程';


$string['type_course'] = '本课程';
$string['type_category'] = '相同类别的课程';
$string['type_meta'] = '透过元课程连结的课程';

$string['maynotaddselfcertforother'] = '你无法为其它用户新增脱机活动记录';
$string['onlyrealusercanaddofflinesessions'] = '只有使用者才可以新增脱机活动记录';
$string['onlyrealusercandeleteofflinesessions'] = '只有使用者才可以删除脱机活动记录';

// Capabilities
$string['attendanceregister:tracked'] = "已设定出席记录";
$string['attendanceregister:viewownregister'] = "可以检视自己的出席记录";
$string['attendanceregister:viewotherregisters'] = "可以检视其它人的出席记录";
$string['attendanceregister:addownofflinesess'] = "可以新增自己的脱机活动记录";
$string['attendanceregister:addotherofflinesess'] = "可以帮他人新增脱机活动记录";
$string['attendanceregister:deleteownofflinesess'] = "可以删除自己的出席记录";
$string['attendanceregister:deleteotherofflinesess'] = "可以删除其它人的出席记录";
$string['attendanceregister:recalcsessions'] = "可以强制重新计算";
$string['attendanceregister:addinstance'] = "新增出席记录模块";

// Buttons & Links labels
$string['force_recalc_user_session'] = '重新计算用户的出席记录';
$string['force_recalc_all_session'] = '重新计算所有出席记录';
$string['force_recalc_all_session_now'] = '立即重新计算出席记录';
$string['schedule_reclalc_all_session'] = '排程计算出席记录';
$string['recalc_scheduled_on_next_cron'] = '已加入排程，将于下个排程启动';
$string['recalc_already_pending'] = '(已延迟排程)';
$string['first_calc_at_next_cron_run'] = '所有过去的记录将在下次排程后显示';
$string['back_to_tracked_user_list'] = '回到使用者列表';
$string['recalc_complete'] = '重新计算完毕';
$string['recalc_scheduled'] = '重新计算已经进入排程中，将在下次排程启用';
$string['offline_session_deleted'] = '脱机活动记录已删除';
$string['offline_session_saved'] = '脱机活动记录已新增';
$string['show_printable'] = '显示可携带版本';
$string['show_my_sessions'] = '显示我的记录';
$string['back_to_normal'] = '回到正常版本';
$string['force_recalc_user_session_help'] = '删除并且重新计算用户的出席记录<br />
一般来说<b>你不需要执行!</b>，因为新的记录会自动加入<br />，只有在以下情况才需要：<br />
<ul><li>改变身份(例如:从老师身份变成学生身份)</li><li>改变追踪方式(例如:改变逾时时间)</ul>';
$string['force_recalc_all_session_help'] = '删除并且重新计算所有的出席记录<br />
一般来说<b>你不需要执行!</b>，因为新的记录会自动加入<br />，只有在以下情况才需要：<br />
<ul><li>改变身份(例如:从老师身份变成学生身份)</li><li>改变追踪方式(例如:改变逾时时间)</ul><br />
当加入新的使用者加入课程时，你不必重新计算，待排程执行即可。';


// Table columns
$string['count'] = '#';
$string['start'] = '开始';
$string['end'] = '结束';
$string['duration'] = '期间';
$string['online_offline'] = '在线/脱机';
$string['ref_course'] = '课程';
$string['comments'] = '内容';
$string['fullname'] = '姓名';
$string['click_for_detail'] = '点击查看详情';
$string['total_time_online'] = '所有在线记录';
$string['total_time_offline'] = '所有脱机记录';
$string['grandtotal_time'] = '总时间';

$string['online'] = '在线';
$string['offline'] = '脱机';
$string['not_specified'] = '(未指定)';
$string['never'] = '(从未)';
$string['session_added_by_another_user'] = '由 {$a} 新增';
$string['unknown'] = '(未知)';

$string['are_you_sure_to_delete_offline_session'] = '你确定要删除脱机活动记录吗?';
$string['online_session_updated'] = "在线出席记录已更新";
$string['updating_online_sessions_of'] = 'Updating online Sessions of {$a}';
$string['online_session_updated_report'] = '{$a->fullname} 更新: {$a->numnewsessions} 笔在线出席记录';

$string['user_sessions_summary'] = '记录一览表';
$string['online_sessions_total_duration'] = '在线出席记录总合';
$string['offline_refcourse_duration'] = '脱机活动记录, 课程名称:';
$string['no_refcourse'] = '(未指定课程)';
$string['offline_sessions_total_duration'] = '脱机活动记录总合';
$string['sessions_grandtotal_duration'] = '所有记录总合';
$string['last_session_logout'] = '最近一次活动记录';
$string['last_calc_online_session_logout'] = '最近一次在线出席记录';
$string['last_site_login'] = '最近一次登入平台';
$string['prev_site_login'] = '前次登入平台';
$string['last_site_access'] = '最近一次记录';

$string['no_session_for_this_user'] = '- 尚未有任何记录 -';
$string['no_tracked_user'] = '- 这个出席统计没有任何一个使用者 -';
$string['no_session'] = '无记录';

$string['tracked_courses'] = '出席记录包含以下课程';
$string['duration_hh_mm'] = '{$a->hours} 小时, {$a->minutes} 分钟';
$string['duration_mm'] = '{$a->minutes} 分钟';

// Offline Session form
$string['select_a_course_if_any'] = '- 选择课程 -';
$string['select_a_course'] = '- 选择课程 -';
$string['insert_new_offline_session'] = '新增脱机活动记录';
$string['insert_new_offline_session_for_another_user'] = '为 {$a->fullname} 新增脱机记录';
//$string['offline_session_form_explain'] = 'You may enter an offline session of work.<br/>
//    The offline work time will be added to the online sessions automatically recorded by the Attendance Register.<br/>
//    The new session may not overlap with any existing work session, either online or offline, nor it may be more than {$a->dayscertificable} days ago.<br/>
//    You may delete any offline session later.';
$string['offline_session_start'] = '开始';
$string['offline_session_start_help'] = '选择起始与结束时间，请注意是否有时间重迭的情形。';
$string['offline_session_end'] = '结束';
$string['offline_session_comments'] = '内容';
$string['offline_session_comments_help'] = '填写脱机活动记录的内容';
$string['offline_session_ref_course'] = '参考课程';
$string['offline_session_ref_course_help'] = 'Select the Course the offline work has been done for or the Course covering the work topic.';

// Offline Sessions validations
$string['login_must_be_before_logout'] = '起始时间必须早于结束时间';
$string['dayscertificable_exceeded'] = '不得早于 {$a} 天前';
$string['overlaps_old_sessions'] = '记录时间重迭';
$string['overlaps_current_session'] = '记录时间与现在时间重迭';
$string['unreasoneable_session'] = '你确定这次记录长达 {$a} 小时!';
$string['logout_is_future'] = 'May not be in the future';

$string['tracked_users'] = '已记录的用户';

// Activity Completion tracking
$string['completiontotalduration'] = '要求时间 [minutes]';
$string['completiondurationgroup'] = '所有记录时间';

$string['eventsessionupdated']= "记录更新";
$string['eventsessionadded']= "新增脱机活动记录";
$string['eventsessiondeleted']= "删除脱机活动记录";
$string['crontask']='排程重新计算出席记录';
