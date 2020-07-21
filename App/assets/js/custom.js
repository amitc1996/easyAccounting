
function before(_this=null){
 _this.find('.save').prop('disabled',true);
 _this.find('.formloader').css("display","inline-block");
}
function complete(_this=null){
_this.find('.save').prop('disabled',false);
_this.find('.formloader').css("display","none");
}

//datatable date split function
function dateSplit(column){
var dateSplit = column.split("-");            
day = dateSplit[2].split(' ');
var curr_date = day[0];
var curr_month = dateSplit[1]; //Months are zero based
var curr_year = dateSplit[0];
return curr_date + "/" + curr_month + "/" + curr_year; 
}
