$("#getvender").select2({
  placeholder:"ค้นหา",
  ajax:{
    url:"getvender",
    dataType: 'json',
    data: function (params) {
          var queryParameters = {
                text: params.term
          }
          return queryParameters;
        } 
  },
  cache: true,
  minimumInputLength: 2,
  formatResult: format,
  formatSelection: format,
  escapeMarkup: function(m) { return m; }
});
$("#getwarehouse").select2({
  placeholder:"เลือก",
  ajax:{
    url:"getwarehouse",
    dataType: 'json',
    data: function (params) {
          var queryParameters = {
                text: params.term
          }
          return queryParameters;
        } 
  },
  cache: true,
  formatResult: format,
  formatSelection: format,
  escapeMarkup: function(m) { return m; }
});
function format(x)
{
  return x.text;
}
function setwarehouse(v_id){
  $.ajax({
    url :"setwarehouse",
    data:{id : v_id},
    success: function(data)
    {
      var dt = JSON.parse(data);
      $("#warecode").val(dt.warecode);
      $("#waredesc").val(dt.waredesc1);
    }
  });
}
function setvender(v_id){
  $.ajax({
    url :"setvendor",
    data:{id : v_id},
    success: function(data)
    {
      var dt = JSON.parse(data);
      $("#vendor").val(dt.vencode);
      $("#vendorname").val(dt.venname1);
    }
  });
}