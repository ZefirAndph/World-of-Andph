var console = {
    info: function (s){
        WSH.Echo(s);
    }
}
var document = {
    write : function (s){
        WSH.Echo(s);
    }
}
var alert = function (s){
    WSH.Echo(s);
}

console.info("test");
document.write("test2");
alert("test3");
