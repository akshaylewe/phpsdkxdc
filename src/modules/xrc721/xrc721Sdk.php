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
    

 //-----------------------READ OPERATIONS-----------------------------//

    /**
     * @dev Gets the Name of the specified address.
     * @param tokenAddress The address of the token.
     * @return an String representing the Name owned by the passed address.
     */
    public function getName($contractAddress){
        $xdc = $this->xdcConnection($contractAddress);
        $name = $xdc->name();
        echo "Name of token: $name \n";
    }

    /**
    *  @dev Gets the Symbol of the specified address.
    * @param tokenAddress The address of the token.
    * @return  an String representing the symbol of the token.
    */
    public function getSymbol($contractAddress){
        $xdc = $this->xdcConnection($contractAddress);
        $symbol = $xdc->symbol();
        echo "Symbol of token: $symbol \n";
    }

    /**
     * @notice Count NFTs tracked by this contract
     * them has an assigned and queryable owner not equal to the zero address
     * @dev Gets the Totalsupply of the specified address.
     * @param tokenAddress An address for whom to query .
     * @return a count of valid NFTs tracked by this contract, where each one of .
     */
    public function getTotalSupply($contractAddress){
        $xdc = $this->xdcConnection($contractAddress);
        $totalSupply = $xdc->totalSupply();
        echo "Totalsupply of token: $totalSupply \n";
    }

    /**
     *  @notice Count all NFTs assigned to an owner
     *  @dev NFTs assigned to the zero address are considered invalid, and this
     *  function throws for queries about the zero address.
     * @dev Gets the balance of the specified address.
     * @param tokenAddress An address for whom to query the balance.
     * @param ownerAddressThe address which owns the funds.
     * @return The number of NFTs owned by `owner`, possibly zero
     */
    public function getBalanceOf($contractAddress,$ownerAddress){
        $xdc = $this->xdcConnection($contractAddress);
        $balanceOf = $xdc->balanceOf($ownerAddress);
        echo "Balance of a token: $balanceOf \n";
    }

    /**
     *  @notice Find the owner of an NFT
     *  @dev NFTs assigned to zero address are considered invalid, and queries about them do throw.
     * @dev Gets the balance of the specified address.
     * @param tokenAddress The address of the token.
     * @param tokenId The identifier for an NFT.
     * @return an String representing the address of the owner of the NFT .
     */
    public function getOwnerOf($contractAddress,$tokenId){
        $xdc = $this->xdcConnection($contractAddress);
        $ownereOf = $xdc->ownerOf($tokenId);
        echo "Owner of a token: $ownereOf \n";
    }

    /**
     * @notice A distinct Uniform Resource Identifier (URI) for a given asset.
     * @param tokenAddress The address of the token.
     * @param tokenId The identifier for an NFT.
     * @return  URI of a token.
     */
    public function getTokenURI($contractAddress,$tokenId){
        $xdc = $this->xdcConnection($contractAddress);
        $tokenUri = $xdc->tokenURI($tokenId);
        echo "URI of a token: $tokenUri \n";
    }

    /** @notice Enumerate NFTs assigned to an owner
     *  @param tokenAddress An address for whom to query .
     *  @param IndexNO A counter less than `totalSupply()`
     *  @return The token identifier for the `index`th NFT assigned to `owner` 
     */
    public function getTokenByIndex($contractAddress,$index){
        $xdc = $this->xdcConnection($contractAddress);
        $tokenId = $xdc->tokenByIndex($index);
        echo "Id of a token: $tokenId \n";
    }

    /** @notice Enumerate NFTs assigned to an owner
     *  @dev Throws if `index` >= `balanceOf(owner)` or if `owner` is the zero address, representing invalid NFTs.
     *  @param tokenAddress An address for whom to query .
     *  @param IndexNO A counter less than `totalSupply()`
     *  @param ownerAddress The address which owns the funds.
     *  @return The token identifier for the `index`th NFT assigned to `owner` 
     */
    public function getTokenOfOwnerByIndex($contractAddress,$ownerAddress,$index){
        $xdc = $this->xdcConnection($contractAddress);
        $tokenId = $xdc->tokenOfOwnerByIndex($ownerAddress,$index);
        echo "Id of a token: $tokenId \n";
    }

     /** @notice Query if a contract implements an interface
     *  @param tokenAddress An address for whom to query .
     *  @param interfaceId The interface identifier
     *  @return `true` if the contract implements `interfaceID` and
     *  `interfaceID` is not 0xffffffff, `false` otherwise .
     */
    public function getSupportInterface($contractAddress,$interfaceId){
        $xdc = $this->xdcConnection($contractAddress);
        $interfaceResult = $xdc->SupportsInterface($interfaceId);
        echo "InterFace Result Status: $interfaceResult \n";
    }

    /** @notice Get the approved address for a single NFT
     *  @dev Throws if `tokenID` is not a valid NFT.
     *  @param tokenAddress An address for whom to query .
     *  @param tokenID      The identifier for an NFT 
     */
    public function getApproved($contractAddress,$tokenId){
        $xdc=$this->xdcConnection($contractAddress,$tokenId);
        $result = $xdc->getApproved($tokenId);
        echo "Approved address: $result \n";
    }

    /** @notice Query if an address is an authorized operator for another address
     *  @param tokenAddress An address for whom to query .
     *  @param ownerAddress The address which owns the funds.
     *  @param operatorAddress The address that acts on behalf of the owner
     *  @return True if `operatorAddress` is an approved operator for `ownerAddress`, False otherwise 
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

// ----------------------WRITE OPERATIONS---------------------------//

    /** @notice Change or reaffirm the approved address for an NFT
     *  @dev The zero address indicates there is no approved address.
     *  Throws unless `owner` is the current NFT owner, or an authorized
     *  @param tokenAddress An address for whom to query .
     *  @param ownerPrivateKey Owner Private key.
     *  @param recieverAddress The address to transfer to .
     *  @param tokenID The identifier for an NFT
     */
    public function approve($contractAddress,$recieverAddress,$tokenId,$ownerPrivateKey){
        $xdc=$this->xdcConnection($contractAddress);
        $approveTransaction = $xdc->approve721($recieverAddress,$tokenId);
        $approveTransactionId = $approveTransaction->sign($ownerPrivateKey)->send();
        echo "Approval Id: " . $approveTransactionId . "\n";
    }

    /** @notice Transfers the ownership of an NFT from one address to another address
     *  @dev This works identically to the other function with an extra data parameter,
     *  except this function just sets data to "".
     *  @param tokenAddress An address for whom to query .
     *  @param ownerAddress owner Of The Token .
     *  @param recieverAddress    The address to transfer to 
     *  @param tokenID      The identifier for an NFT
     *  @param approvedPrivateKey    Approved Address Private key.
    */
    public function safeTransferFrom($contractAddress,$ownerAddress,$recieverAddress,$tokenId,$approvedPrivateKey){
        $xdc=$this->xdcConnection($contractAddress);
        $transferTransaction = $xdc->safeTransferFrom($ownerAddress,$recieverAddress,$tokenId);
        $transferTransactionId = $transferTransaction->sign($approvedPrivateKey)->send();
        echo "transferID: ". $transferTransactionId ."\n" ;
    }

    /** @notice Transfer ownership of an NFT -- THE CALLER IS RESPONSIBLE
     *  TO CONFIRM THAT `recieverAddress` IS CAPABLE OF RECEIVING NFTS OR ELSE THEY MAY BE PERMANENTLY LOST
     *  @dev Throws unless `ownerAddress` is the current owner, an authorized .
     *  @param tokenAddress An address for whom to query .
     *  @param ownerAddress owner Of The Token .
     *  @param recieverAddress The address to transfer to 
     *  @param tokenID The identifier for an NFT
     *  @param approvedPrivateKey Approved Address Private key.
     */
    public function transferFrom($contractAddress,$ownerAddress,$recieverAddress,$tokenId,$approvedPrivateKey){
        $xdc=$this->xdcConnection($contractAddress);
        $transferTransaction = $xdc->transferFrom721($ownerAddress,$recieverAddress,$tokenId);
        $transferTransactionId = $transferTransaction->sign($approvedPrivateKey)->send();
        echo "transferID: ". $transferTransactionId ."\n" ;
    }
    
     /** @notice Enable or disable approval for a third party ("operator") to manage all of `Owner`'s assets
     *  @dev Emits the ApprovalForAll event. The contract MUST allow multiple operators per owner.
     *  @param token_address An address for whom to query .
     *  @param operatorAddress An address for whoom you want to give to give Approve Status.
     *  @param approvedStatus true if the operator is approved, false to revoke approval
     *  @param ownerPrivateKey PrivateKey Of The Token Owner .
     * @param tokenId The identifier for an NFT
     */

    public function setApprovalForAll($contractAddress,$operatorAddress,$approvedStatus,$ownerPrivateKey,$tokenId){
        $xdc=$this->xdcConnection($contractAddress);
        $approveTransaction = $xdc->setApprovalForAll($operatorAddress,$approvedStatus,$tokenId);
        $approveTransactionId = $approveTransaction->sign($ownerPrivateKey)->send();
        echo "Approval Id :-" . $approveTransactionId . "\n"; 
    }
    
    function transfer($contractAddress,$senderAddress,$senderPrivateKey,$reciverAddress,$tokenId){
        $xdc=$this->xdcConnection($contractAddress);
        $ownerAddress = $xdc->ownerOf($tokenId);
        if ($senderAddress === $ownerAddress ){
            $transferTransaction = $xdc->transfer($senderAddress,$reciverAddress,$tokenId);
            $transferTransactionId = $transferTransaction->sign($senderPrivateKey)->send();
            echo "transferID: ". $transferTransactionId ."\n" ;
        }else{
            echo "SenderAddress must be a Owner address. " ;
        }
            
        
        }
    
 
}

?>