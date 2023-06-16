var labels = document.getElementsByClassName('ats');

angular.module('App', []).controller('Ctrl', function($scope,$http) {

    var url = "/api/dailyreport.php" + window.location.search;
    $http.get(url)
    .then(function (response) {
        $scope.atsdata = response.data;

        var pre_list = $scope.atsdata[0].present_list.split(',');
        var abs_list = $scope.atsdata[0].absent_list.split(',');
        
        if (abs_list[0] == ""){
            var full_list = pre_list;
        }
        else if (pre_list[0] == ""){
            var full_list = abs_list;
        }
        else{
            var full_list = pre_list.concat(abs_list);
        }
        full_list.sort();
        $scope.attendancelist = [];

        for (let i = 0; i < labels.length; i++) {
            var sid = labels.item(i).id;
            if(pre_list.includes(sid))
            {
                var index = full_list.indexOf(sid);
                $scope.attendancelist[index] = "P";
            }
            else
            {
                var index = full_list.indexOf(sid);
                $scope.attendancelist[index] = "A";
            }
        }
    });

});

function logs()
{
    var arr_pid = [];
    var arr_aid = [];
    
    var list_p = document.getElementById('list_p');
    var list_a = document.getElementById('list_a');
    list_p.innerText = "";
    list_a.innerText = "";

    for (let i = 0; i < labels.length; i++) {
        var sid = labels.item(i).id+",";

        if(labels.item(i).classList.contains('P'))
        {
            arr_pid.push(sid);
            list_p.innerText += sid;
        }
        else
        {
            arr_aid.push(sid);
            list_a.innerText += sid;
        }
    }
    list_p.innerText = list_p.innerText.substr(0,list_p.innerText.length-1);
    list_a.innerText = list_a.innerText.substr(0,list_a.innerText.length-1);

    var totalstd = document.getElementById('tot');
    var tot_p = document.getElementById('tot_p');
    var tot_a = document.getElementById('tot_a');
    
    var total_p = document.getElementById('total_p');
    var total_a = document.getElementById('total_a');

    totalstd.innerText = labels.length;
    tot_p.innerText = "Present Students: " + arr_pid.length;
    tot_a.innerText = "Absent Students: " + arr_aid.length;

    total_p.value = arr_pid.length;
    total_a.value = arr_aid.length;
}