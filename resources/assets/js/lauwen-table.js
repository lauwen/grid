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
                    <td colspan="`+lauwen_grid_data_fields[0].length+`" align="center">还没有数据哦！</td>
                </tr>`;
            } else {
                for (var i = 0; i < res.length; i++) {
                    lauwen_grid_data_subtable_content += `<tr>`;
                    for (var j = 0; j < lauwen_grid_data_fields[0].length; j++) {
                        var lauwen_grid_data_field = lauwen_grid_data_fields[0][j];
                        lauwen_grid_data_subtable_content += `<td>`+res[i][lauwen_grid_data_field]+`</td>`;
                    }
                    lauwen_grid_data_subtable_content +=`</tr>`;
                }
            }
            $("#lauwen-grid-data-subtable-left tbody").html(lauwen_grid_data_subtable_content);
        }
    });
    $.ajax({
        url: lauwen_grid_data_urls[1],
        type: "get",
        data:{la_id:lauwen_grid_data_row_id},
        success: function (data) {
            var res = JSON.parse(data);
            var lauwen_grid_data_subtable_content = '';
            if (res.length == 0) {
                lauwen_grid_data_subtable_content += `<tr>
                    <td colspan="`+lauwen_grid_data_fields[1].length+`" align="center">还没有数据哦！</td>
                </tr>`;
            } else {
                for (var i = 0; i < res.length; i++) {
                    lauwen_grid_data_subtable_content += `<tr>`;
                    for (var j = 0; j < lauwen_grid_data_fields[1].length; j++) {
                        var lauwen_grid_data_field = lauwen_grid_data_fields[1][j];
                        lauwen_grid_data_subtable_content += `<td>`+res[i][lauwen_grid_data_field]+`</td>`;
                    }
                    lauwen_grid_data_subtable_content +=`</tr>`;
                }
            }
            $("#lauwen-grid-data-subtable-right tbody").html(lauwen_grid_data_subtable_content);
        }
    });
}
