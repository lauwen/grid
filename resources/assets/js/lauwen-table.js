function lauwenGridGetSubformData (obj) {
    var lauwen_grid_data_row_id = $(obj).data("key");
    var lauwen_grid_data_fields = $(obj).data("fields");
    var lauwen_grid_data_urls = $(obj).data("urls");
    $.ajax({
        url: lauwen_grid_data_urls[0],
        type: "get",
        data:{la_id:lauwen_grid_data_row_id},
        success: function (data) {
            var res = JSON.parse(data);
            var lauwen_grid_data_subtable_content = '';
            if (res.length == 0) {
                lauwen_grid_data_subtable_content += `<tr>
                    <td colspan="`+lauwen_grid_data_fields[0].length+`" align="center" data-name="none">还没有数据哦！</td>
                </tr>`;
            } else {
                for (var i = 0; i < res.length; i++) {
                    lauwen_grid_data_subtable_content += `<tr>`;
                    for (var j = 0; j < lauwen_grid_data_fields[0].length; j++) {
                        var lauwen_grid_data_field = lauwen_grid_data_fields[0][j];
                        // if ($("#lauwen-grid-data-subtable-left").prev().children("div:last-child").children("button").length > 0) {
                        if (lauwen_grid_data_field.editable==true) {
                            lauwen_grid_data_subtable_content += `<td  align="center" onclick="tdclick(this)" data-name="`+lauwen_grid_data_field.field+`">`+res[i][lauwen_grid_data_field.field]+`<i class="glyphicon glyphicon-edit"></i></td>`;
                        }else{
                            lauwen_grid_data_subtable_content += `<td  align="center">`+res[i][lauwen_grid_data_field.field]+`</td>`;
                        }
                    }
                    lauwen_grid_data_subtable_content +=`</tr>`;
                }
            }
            $("#lauwen-grid-data-subtable-left tbody").html(lauwen_grid_data_subtable_content);
        }
    });
    if (lauwen_grid_data_urls[1]) {
        $.ajax({
            url: lauwen_grid_data_urls[1],
            type: "get",
            data:{la_id:lauwen_grid_data_row_id},
            success: function (data) {
                var res = JSON.parse(data);
                var lauwen_grid_data_subtable_content = '';
                if (res.length == 0) {
                    lauwen_grid_data_subtable_content += `<tr>
                    <td colspan="`+lauwen_grid_data_fields[1].length+`" align="center" data-name="none">还没有数据哦！</td>
                </tr>`;
                } else {
                    for (var i = 0; i < res.length; i++) {
                        lauwen_grid_data_subtable_content += `<tr>`;
                        for (var j = 0; j < lauwen_grid_data_fields[1].length; j++) {
                            var lauwen_grid_data_field = lauwen_grid_data_fields[1][j];
                            // if ($("#lauwen-grid-data-subtable-right").prev().children("div:last-child").children("button").length > 0) {
                            if (lauwen_grid_data_field.editable==true) {
                                lauwen_grid_data_subtable_content += `<td  align="center" onclick="tdclick(this)" data-name="`+lauwen_grid_data_field.field+`">`+res[i][lauwen_grid_data_field.field]+`<i class="glyphicon glyphicon-edit"></i></td>`;
                            }else{
                                lauwen_grid_data_subtable_content += `<td  align="center">`+res[i][lauwen_grid_data_field.field]+`</td>`;
                            }
                        }
                        lauwen_grid_data_subtable_content +=`</tr>`;
                    }
                }
                $("#lauwen-grid-data-subtable-right tbody").html(lauwen_grid_data_subtable_content);
            }
        });
    }
}



function lauwenGridSaveSubformData(obj, url, token){
    var tableinfo = gettableinfo(obj);
    if (tableinfo === false) {
        toastr.warning("没有数据可以提交！");
        return;
    }
    tableinfo = JSON.parse(tableinfo);
    $.ajax({
        url: url,
        type: "post",
        data:{
            la_data:tableinfo,
            _token: token
        },
        success: function (data) {
            var res = JSON.parse(data);
            if (res) {
                toastr.success("保存成功！");
                return;
            }
            toastr.error("保存失败！");
        }
    });
}

function gettableinfo(obj){
    var str = "";
    var tabledata = "";
    var table = $("#"+obj);
    var tbody = table.children();
    var trs = tbody.children();
    for(var i=1;i<trs.length;i++){
        var tds = trs.eq(i).children();
        if (trs.length == 2 && tds.length==1 && tds.eq(0).data("name")=="none") {
            console.log(1335458);
            return false;
        }
        for(var j=0;j<tds.length;j++){
            if(j == 0){
                str = "\""+tds.eq(j).data("name")+"\":\""+tds.eq(j).text()+"\"";
            } else {
                str += ",\""+tds.eq(j).data("name")+"\":\""+tds.eq(j).text()+"\"";
            }
        }
        if(i==trs.length-1){
            tabledata += "{"+str+"}";
        }else{
            tabledata += "{"+str+"},";
        }
    }
    tabledata = "["+tabledata+"]";
    return tabledata;
}

function tdclick(tdobject){
    var td=$(tdobject);
    td.attr("onclick", "");
    var text=td.text();
    td.html("");
    var input=$("<input>");
    input.attr("value",text);
    input.css({
        "width": "80px",
        "textAlign": "center",
    });
    input.bind("blur",function(){
        var inputnode=$(this);
        var inputtext=inputnode.val();
        var tdNode=inputnode.parent();
        tdNode.html(inputtext);
        tdNode.click(tdclick);
        td.attr("onclick", "tdclick(this)");
    });
    input.keyup(function(event){
        var myEvent =event||window.event;
        var kcode=myEvent.keyCode;
        if(kcode==13){
            var inputnode=$(this);
            var inputtext=inputnode.val();
            var tdNode=inputnode.parent();
            tdNode.html(inputtext);
            tdNode.click(tdclick);
        }
    });

    td.append(input);
    var t =input.val();
    input.val("").focus().val(t);

    td.unbind("click");
}
function addtr(){
    var table = $("#para_table");
    var tr= $("<tr>" +
        "<td  onclick='tdclick(this)'>"+"</td>" +
        "<td  onclick='tdclick(this)'>"+"</td>" +
        "<td  align='center' onclick='deletetr(this)'><button type='button'  class='btn btn-xs btn-link' >"+"删除"+"</button></td></tr>");
    table.append(tr);
}
function deletetr(tdobject){
    var td=$(tdobject);
    td.parents("tr").remove();
}
