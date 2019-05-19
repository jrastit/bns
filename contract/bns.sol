pragma solidity >=0.4.22 <0.6.0;

contract BNS {

    uint nb_record = 0;

    struct Record {
        uint stack;
        //uchar[4] ip;
        uint32 ip;
        bytes32 dns;
        address payable owner;
    }
    
    uint constant Max_record = 100;
    
    struct Keyword {
        Record[Max_record] records;
        uint nb_records;
    }
    
    //public mapping(bytes32=>[Max_record]Record) records;
    mapping(bytes32=>Keyword) public keywords;
    
    /// Create a new record with $(_keyword).
    constructor() public {
    }
    
    function addRecord(bytes32 _keyword, uint32 _ip, bytes32 _dns) public payable{
        if (keywords[_keyword].nb_records != 0){
            if (keywords[_keyword].nb_records < Max_record){
                keywords[_keyword].nb_records = keywords[_keyword].nb_records + 1;
            }
        }else{
            keywords[_keyword].nb_records = 1;
            
            //keywords[_keyword] = Keyword([], 1);
        }
        
        Record memory my_record = Record(msg.value, _ip, _dns, msg.sender);
        Record memory my_record2;
        Record memory my_record3;
        for (uint8 i = 0;i < keywords[_keyword].nb_records && i < Max_record; i = i + 1) {
            if (keywords[_keyword].records[i].owner == address(0)){
                keywords[_keyword].records[i] = my_record;
                break;
            } else if (msg.value > keywords[_keyword].records[i].stack){
                my_record2 = keywords[_keyword].records[i];
                keywords[_keyword].records[i] = my_record;
                my_record = my_record2;
                my_record3 = my_record2;
            }
        }
        if (my_record3.owner != address(0)){
            address payable owner = my_record3.owner;
            owner.transfer(my_record3.stack);
        }
        
    }
    
    function removeRecord(bytes32 _keyword, uint32 _ip, bytes32 _dns) public{
        
        require (keywords[_keyword].nb_records != 0);
        
        uint8 record_found = 0;
        
        for (uint8 i = 0; i < keywords[_keyword].nb_records; i = i + 1) {
            if (record_found == 0 && keywords[_keyword].records[i].ip == _ip && keywords[_keyword].records[i].dns == _dns && msg.sender == keywords[_keyword].records[i].owner){
                record_found = 1;
                msg.sender.transfer(keywords[_keyword].records[i].stack);
            }
            if (record_found == 1){
                if (i < keywords[_keyword].nb_records - 1){
                    keywords[_keyword].records[i].dns = keywords[_keyword].records[i + 1].dns;
                    keywords[_keyword].records[i].ip = keywords[_keyword].records[i + 1].ip;
                    keywords[_keyword].records[i].owner = keywords[_keyword].records[i + 1].owner;
                    keywords[_keyword].records[i].stack = keywords[_keyword].records[i + 1].stack;
                }else{
                    keywords[_keyword].records[i].dns = "";
                    keywords[_keyword].records[i].ip = 0;   
                    keywords[_keyword].records[i].owner = address(0);
                    keywords[_keyword].records[i].stack = 0;
                }
            }
        }
        
        if (record_found == 1){
            keywords[_keyword].nb_records--;
        }
    }
   
    function getIp(bytes32 _keyword) public view returns(uint32[] memory _ip){
        uint32[] memory v = new uint32[](keywords[_keyword].nb_records);
        uint counter = 0;
        for (uint8 i = 0;i < keywords[_keyword].nb_records; i++) {
            v[counter] = keywords[_keyword].records[counter].ip;
            counter++;
        }
        return v;
   }
   
   function getIpStack(bytes32 _keyword) public view returns(bytes32[] memory _dns, uint32[] memory _ip, uint[] memory  _stack){
        bytes32[] memory d = new bytes32[](keywords[_keyword].nb_records);
        uint32[] memory v = new uint32[](keywords[_keyword].nb_records);
        uint[] memory s = new uint[](keywords[_keyword].nb_records);
        uint counter = 0;
        for (uint8 i = 0;i < keywords[_keyword].nb_records; i++) {
            d[counter] = keywords[_keyword].records[counter].dns;
            v[counter] = keywords[_keyword].records[counter].ip;
            s[counter] = keywords[_keyword].records[counter].stack;
            counter++;
        }
        return (d, v, s);
   }
}
