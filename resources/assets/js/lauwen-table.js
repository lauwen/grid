function lauwenGridGetSubformData (obj, url) {
    var lauwen_grid_data_row_id = $(obj).data("key");
    var lauwen_grid_data_fields = $(obj).data("fields");
    $.ajax({
        url: url,
        type: "get",
        data:{la_id:lauwen_grid_data_row_id},
        success: function (data) {
            var res = JSON.parse(data);
            var lauwen_grid_data_subtable_content = '';
            if (res.length == 0) {
                lauwen_grid_data_subtable_content += `<tr>
                    <td colspan="5" align="center">还没有数据哦！</td>
                </tr>`;
            } else {
                for (var i = 0; i < res.length; i++) {
                    lauwen_grid_data_subtable_content += `<tr>`;
                    for (var j = 0; j < lauwen_grid_data_fields.length; j++) {
                        var lauwen_grid_data_field = lauwen_grid_data_fields[j];
                        lauwen_grid_data_subtable_content += `<td>`+res[i][lauwen_grid_data_field]+`</td>`;
                    }
                    lauwen_grid_data_subtable_content +=`</tr>`;
                }
            }
            $("#lauwen-grid-data-subtable tbody").html(lauwen_grid_data_subtable_content);
        }
    });
}
