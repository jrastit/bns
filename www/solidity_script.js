
if (typeof web3 !== "undefined") 
{
 web3 = new Web3(web3.currentProvider);
 } 
else 
{
 // set the provider you want from Web3.providers
web3.setProvider(new web3.providers.HttpProvider("https://rinkeby.infura.io/v3/33b80c3a509e419d8cb3abe52dfb7710"));
//web3 = new Web3(new Web3.providers.HttpProvider("http://localhost:8545"));
 }
/*
var Web3 = require("web3");
var web3 = new Web3();
web3.setProvider(new web3.providers.HttpProvider("https://rinkeby.infura.io/v3/33b80c3a509e419d8cb3abe52dfb7710"));
*/
var bnsABI =[
	{
		"constant": false,
		"inputs": [
			{
				"name": "_keyword",
				"type": "bytes32"
			},
			{
				"name": "_ip",
				"type": "uint32"
			},
			{
				"name": "_dns",
				"type": "bytes32"
			}
		],
		"name": "addRecord",
		"outputs": [],
		"payable": true,
		"stateMutability": "payable",
		"type": "function"
	},
	{
		"constant": false,
		"inputs": [
			{
				"name": "_keyword",
				"type": "bytes32"
			},
			{
				"name": "_ip",
				"type": "uint32"
			},
			{
				"name": "_dns",
				"type": "bytes32"
			}
		],
		"name": "removeRecord",
		"outputs": [],
		"payable": false,
		"stateMutability": "nonpayable",
		"type": "function"
	},
	{
		"inputs": [],
		"payable": false,
		"stateMutability": "nonpayable",
		"type": "constructor"
	},
	{
		"constant": true,
		"inputs": [
			{
				"name": "_keyword",
				"type": "bytes32"
			}
		],
		"name": "getIp",
		"outputs": [
			{
				"name": "_ip",
				"type": "uint32[]"
			}
		],
		"payable": false,
		"stateMutability": "view",
		"type": "function"
	},
	{
		"constant": true,
		"inputs": [
			{
				"name": "_keyword",
				"type": "bytes32"
			}
		],
		"name": "getIpStack",
		"outputs": [
			{
				"name": "_dns",
				"type": "bytes32[]"
			},
			{
				"name": "_ip",
				"type": "uint32[]"
			},
			{
				"name": "_stack",
				"type": "uint256[]"
			}
		],
		"payable": false,
		"stateMutability": "view",
		"type": "function"
	},
	{
		"constant": true,
		"inputs": [
			{
				"name": "",
				"type": "bytes32"
			}
		],
		"name": "keywords",
		"outputs": [
			{
				"name": "nb_records",
				"type": "uint256"
			}
		],
		"payable": false,
		"stateMutability": "view",
		"type": "function"
	}
];



web3.eth.defaultAccount = web3.eth.accounts[0];
//personal.unlockAccount(web3.eth.defaultAccount)

var bnsContract = web3.eth.contract(bnsABI);

var bnsContractInstance = bnsContract.at("0x3416f353e1346e2a82538d5ffe60f5c479f2284d");

//bnsContract.web3.eth.defaultAccount=Contractinstance.web3.eth.coinbase;

//bnsContractInstance.web3.eth.defaultAccount=Contractinstance.web3.eth.coinbase;

function ip2int(ip) {
    return ip.split('.').reduce(function(ipInt, octet) { return (ipInt<<8) + parseInt(octet, 10)}, 0) >>> 0;
}

function int2ip (ipInt) {
    return ( (ipInt>>>24) +'.' + (ipInt>>16 & 255) +'.' + (ipInt>>8 & 255) +'.' + (ipInt & 255) );
}

function add_record(_keyword, _ip, _dns, _gaz){

	window.ethereum.enable();
	
	var value = web3.sha3(_keyword.toLowerCase());
	console.log(value);
	var params = {
		gas: 4000000,
		from: web3.eth.accounts[0],
		value: _gaz
		};
	
	console.log(web3.eth.coinbase);
	

	bnsContractInstance.addRecord(value, ip2int(_ip), web3.fromAscii(_dns), params, function(error, result){
   if(!error)
       console.log(JSON.stringify(result));
   else
       console.error(error);
});
};

function get_ip(_keyword){

	//window.ethereum.enable();

	
	var value = web3.sha3(_keyword.toLowerCase());
	console.log(value);
	var params = {
		gas: 4000000,
		from: web3.eth.accounts[0],
		};
	
	//console.log(int2ip(ip2int("127.0.0.1")));
	ret = bnsContractInstance.getIp(value, params);
	/*
	ret.forEach(function(element) {
	  console.log(int2ip(element));
	});
	$("#search_result").empty();
	*/
	var i;
	console.log("ret=>", ret);
	for (i = 0; i < ret.length; i++){
		var ip = int2ip(ret[i]);
		$("#search_result").html("<p>Result:</p><a href='http://" + ip + "'>" + ip + "</a><br>");
	}
	if (ret.length == 0){
		$("#search_result").html("<p>No result</p><br>");
	}
	return ret;
};

function get_ip_stack(_keyword){

	
	var value = web3.sha3(_keyword.toLowerCase());
	var params = {
		gas: 4000000,
		from: web3.eth.accounts[0],
		};
	
	ret = bnsContractInstance.getIpStack(value, params, function(error, result){
   		if(!error){
	   	    console.log(JSON.stringify(result));
			var i;
			console.log("ret=>", result);
			if (!result || result.length == 0){
				$("#search_result").html("<p>No result</p><br>");
			}else{
				$("#search_result").empty();
			}
			for (i = 0; result && i < result[0].length; i++){
				var dns = web3.toAscii(result[0][i]).replace(/\u0000/g, '');
				var ip = int2ip(result[1][i]);
				var stack = result[2][i];
				$("#search_result").append("<p style='margin-top:1em;'><a href='https://" + dns + "'>" + dns + "("+ stack + ")</a></p><div onclick=\"location.href='https://" + dns + "';\" id='search_result_" + i + "'></div>");
				page_info(dns, "#search_result_" + i);
			}
	   }else{
	       console.error(error);
		}
	});	
	
	
	return ret;
};

function page_info(url, element){
	$( element ).load( "engine.php?dns="+url );
	/* 
    $.ajax({
          type: 'GET', 
          url: url,
          dataType: 'html',
          success: function(data) {

            //cross platform xml object creation from w3schools
            try //Internet Explorer
              {
              xmlDoc=new ActiveXObject("Microsoft.XMLDOM");
              xmlDoc.async="false";
              xmlDoc.loadXML(data);
              }
            catch(e)
              {
              try // Firefox, Mozilla, Opera, etc.
                {
                parser=new DOMParser();
                xmlDoc=parser.parseFromString(data,"text/xml");
                }
              catch(e)
                {
                alert(e.message);
                return;
                }
              }

            var metas = xmlDoc.getElementsByTagName("meta");
            for (var i = 0; i < metas.length; i++) {
              if (metas[i].getAttribute("name") == "description") {
                //alert(metas[i].getAttribute("content") || metas[i].getAttribute("edit"));
		$(element).html("<p>" + metas[i].getAttribute("content") + "</p>");
              }
            }
          }
    }); */
  }

