<?php


//declare class with nameSpace for importing in another file
namespace XRC721\SDK;

//Importing Library
use web3\token\token721;
            
//THIS IS A CLASS WHICH CONSISTS ALL THE METHODS AS XRC721 STANDARDS.
class XRC721SDK {

    /**
     * Function For Making a Connection with xdc apotheum testnet.
     * $Contract address input given by console.
     * Apotheum address is constant fetching from constant.php file.
     * Return connection object.
     */
    public function xdcConnection($contractAddress){
        $apothemAddress = getenv('URL');
        $xdcConnection = new token721($contractAddress,$apothemAddress);
        return $xdcConnection ;
    }
    

    /**
     * getName method
     * By this method we can get name of a token.  ---e.g. "XDC_Demo"
     */
    public function getName($contractAddress){
        $xdc = $this->xdcConnection($contractAddress);
        $name = $xdc->name();
        echo "Name of token: $name \n";
    }


    /**
     * getSymbol method
     * By this method we can get symbol of a token.  ---e.g. "XDC"
     */
    public function getSymbol($contractAddress){
        $xdc = $this->xdcConnection($contractAddress);
        $symbol = $xdc->symbol();
        echo "Symbol of token: $symbol \n";
    }


    /**
     * getTotalSupply method
     * By this method we can get totalSupply of a token. ----e.g. "10000000"
     */
    public function getTotalSupply($contractAddress){
        $xdc = $this->xdcConnection($contractAddress);
        $totalSupply = $xdc->totalSupply();
        echo "Totalsupply of token: $totalSupply \n";
    }


    /**
     * getBalanceOf method
     * By this method we can get balance of a token. ----e.g. "100000"
     */
    public function getBalanceOf($contractAddress,$ownerAddress){
        $xdc = $this->xdcConnection($contractAddress);
        $balanceOf = $xdc->balanceOf($ownerAddress);
        echo "Balance of a token: $balanceOf \n";
    }


    /**
     * getOwnerOf method
     * By this method we can get ownerAddress of a token. ----e.g. "0x....."
     */
    public function getOwnerOf($contractAddress,$tokenId){
        $xdc = $this->xdcConnection($contractAddress);
        $ownereOf = $xdc->ownerOf($tokenId);
        echo "Owner of a token: $ownereOf \n";
    }


    /**
     * getTokenURI method
     * By this method we can get URI of a token.
     */
    public function getTokenURI($contractAddress,$tokenId){
        $xdc = $this->xdcConnection($contractAddress);
        $tokenUri = $xdc->tokenURI($tokenId);
        echo "URI of a token: $tokenUri \n";
    }


    /**
     * getTokenByIndex method
     * By this method we can get URI of a token.
     */
    public function getTokenByIndex($contractAddress,$index){
        $xdc = $this->xdcConnection($contractAddress);
        $tokenId = $xdc->tokenByIndex($index);
        echo "Id of a token: $tokenId \n";
    }


    /**
     * getTokenOfOwnerByIndex method
     * By this method we can get URI of a token.
     */
    public function getTokenOfOwnerByIndex($contractAddress,$ownerAddress,$index){
        $xdc = $this->xdcConnection($contractAddress);
        $tokenId = $xdc->tokenOfOwnerByIndex($ownerAddress,$index);
        echo "Id of a token: $tokenId \n";
    }


    /**
     * getSupportInterface method
     * By this method we can get URI of a token.
     */
    public function getSupportInterface($contractAddress,$interfaceId){
        $xdc = $this->xdcConnection($contractAddress);
        $interfaceResult = $xdc->SupportsInterface($interfaceId);
        echo "InterFace Result Status: $interfaceResult \n";
    }


    /**
     * Aprroval Method
     */
    public function approve($contractAddress,$recieverAddress,$tokenId,$privateKey){
        $xdc=$this->xdcConnection($contractAddress);
        $approveTransaction = $xdc->approve($recieverAddress,$tokenId);
        $approveTransactionId = $approveTransaction->sign($privateKey)->send();
        echo "Approval Id: " . $approveTransactionId . "\n";
    }


    /**
     * getApproved method
     */
    public function getApproved($contractAddress,$tokenId){
        $xdc=$this->xdcConnection($contractAddress,$tokenId);
        $result = $xdc->getApproved($tokenId);
        echo "Approved address: $result \n";
    }


    /**
     * SafeTransferFrom Method
     */
    public function safeTransferFrom($contractAddress,$ownerAddress,$recieverAddress,$tokenId,$approvedPrivateKey){
        $xdc=$this->xdcConnection($contractAddress);
        $transferTransaction = $xdc->safeTransferFrom($ownerAddress,$recieverAddress,$tokenId);
        $transferTransactionId = $transferTransaction->sign($approvedPrivateKey)->send();
        echo "transferID". $transferTransactionId ."\n" ;
    }


    /**
     * TransferFrom Method
     */
    public function transferFrom($contractAddress,$ownerAddress,$recieverAddress,$tokenId,$approvedPrivateKey){
        $xdc=$this->xdcConnection($contractAddress);
        $transferTransaction = $xdc->transferFrom($ownerAddress,$recieverAddress,$tokenId);
        $transferTransactionId = $transferTransaction->sign($approvedPrivateKey)->send();
        echo "transferID". $transferTransactionId ."\n" ;
    }
    
    
    /**
     * setApprovalForAll method
     */
    public function setApprovalForAll($contractAddress,$operatorAddress,$approvedStatus,$ownerPrivateKey,$tokenId){
        $xdc=$this->xdcConnection($contractAddress);
        $approveTransaction = $xdc->setApprovalForAll($operatorAddress,$approvedStatus,$tokenId);
        $approveTransactionId = $approveTransaction->sign($ownerPrivateKey)->send();
        echo "Approval Id :-" . $approveTransactionId . "\n"; 
    }
    

    /**
     * isApprovalForAll method
     */
    public function isApprovedForAll($contractAddress,$ownerAddress,$operatorAddress){
        $xdc=$this->xdcConnection($contractAddress);
        $result = $xdc->isApprovedForAll($ownerAddress, $operatorAddress);
        if ($result == 1){
            echo "Status: True \n";
        }else{
            echo "Status: False \n";
        }  
    } 
}

?>