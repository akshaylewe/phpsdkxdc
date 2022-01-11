<?php


//Declare class with nameSpace for importing in another file
namespace XRC20\SDK;

//Importing Library
use web3\token\token20;

//THIS IS A CLASS WHICH CONSISTS ALL THE METHODS AS XRC20 STANDARDS.
class XRC20SDK {

    /**
     * Function For Making a Connection with xdc apotheum testnet.
     * $Contract address input given by console.
     * Apotheum address is constant fetching from constant.php file.
     * Return connection object.
     */
    public function xdcConnection($contractAddress){
        $apothemAddress = getenv('URL');
        $xdcConnection = new token20($contractAddress,$apothemAddress);
        return $xdcConnection ;
    }
    
    /**
     * getName method
     * By this method we can get name of a token. ---e.g. "XDC_Demo"
     */
    public function getName($contractAddress){
        $xdc = $this->xdcConnection($contractAddress);
        $name = $xdc->name();
        echo "Name of token: $name \n";
    }

    /**
     * getDecimal method
     * By this Method we can get decimals of a token.--e.g. "18"
     */
    public function getDecimal($contractAddress){
        $xdc = $this->xdcConnection($contractAddress);
        $decimal = $xdc->decimals();
        echo "Decimals of token: $decimal \n";
    }

    /**
     * getSymboll method
     * By this Method we can get Symbol of a token.--e.g. "XDC"
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
     * getAllowance method
     * By this method we can get how much allowance spender have from owner
     * Owneraddress & Spender address input given by console.
     * Return allowance
     */
    public function getAllowance($contractAddress,$ownerAddress,$spenderAddress){
        $xdc = $this->xdcConnection($contractAddress);
        $allowance = $xdc->allowance($ownerAddress,$spenderAddress);
        echo "Allowance of token: $allowance \n";
    }

    /**
     * getBalanceOf method
     * By this method we can get how much token balance particular admin have.
     * Admin address input given by console.
     * Return tokenBalance of Admin
     */
    public function getBalanceOf($contractAddress,$ownerAddress){
        $xdc = $this->xdcConnection($contractAddress);
        $balanceOf = $xdc->balanceOf($ownerAddress);
        echo "Balance of a token: $balanceOf \n";
    }


    // /**
    //  * getApprove method
    //  * By this method we can give permisson to use token balance to the spender from owner.
    //  * Tokenamount input given by console.
    //  * Owner address input given by console.
    //  * Owner address privatekey input given by console.
    //  * Spender address input given by console.
    //  * Return hash value.
    //  */
    public function getApprove(string $contractAddress,string $ownerAddress, $ownerPrivateKey,string $spenderAddress,float $tokenAmount){
        $xdc = $this->xdcConnection($contractAddress);
        $balance = $xdc->balanceOf($ownerAddress);
        if ($tokenAmount <= $balance){
            $approveTransaction = $xdc->approve($ownerAddress,$spenderAddress, $tokenAmount);
            $approveTransactionId = $approveTransaction->sign($ownerPrivateKey)->send();
            echo "Permission granted to this account ( $spenderAddress ) to use upto $tokenAmount tokens from this account( $ownerAddress ). Approval id is: $approveTransactionId \n";
            // return $approveTransactionId;
            echo $ownerPrivateKey;
            echo gettype($ownerPrivateKey);
        }else{
            echo "Insufficient balance in this token. Your current token balance is: $balance \n";
        }
    }

    // /**
    //  * decreaseAllowance method.
    //  * By this method we can decrease allowance to the spender from owner.
    //  * Tokenamount input given by console.
    //  * Owner address input given by console.
    //  * Owner address privatekey input given by console.
    //  * Spender address input given by console.
    //  * Return hash value
    //  */
    public function decreaseAllowance(string $contractAddress,string $ownerAddress,string $ownerPrivateKey,string $spenderAddress,float $tokenAmount){
        $xdc = $this->xdcConnection($contractAddress);
        $allowance = $xdc->allowance($ownerAddress,$spenderAddress);
        if ($tokenAmount <= $allowance){
            $decreaseTransaction = $xdc->decreaseAllowance($ownerAddress,$spenderAddress,$tokenAmount);
            $decreaseTransactionId = $decreaseTransaction->sign($ownerPrivateKey)->send();
            echo "Allowance decreased by $tokenAmount successfully. The transaction id is: $decreaseTransactionId \n";
        }else{
            echo "Enter sufficient amount to decrease. your current allowance is: $allowance \n";
        }
    }


    // /**
    //  * increaseAllowance method.
    //  * By this method we can increase allowance to the spender from owner.
    //  * Tokenamount input given by console.
    //  * Owner address input given by console.
    //  * Owner address privatekey input given by console.
    //  * Spender address input given by console.
    //  * Return hash value.
    //  */
    public function increaseAllowance(string $contractAddress,string $ownerAddress,string $ownerPrivateKey,string $spenderAddress,float $tokenAmount){
        $xdc = $this->xdcConnection($contractAddress);
        $balance = $xdc->balanceOf($ownerAddress);
        $allowance = $xdc->allowance($ownerAddress,$spenderAddress);
        if ($tokenAmount <= ($balance-$allowance)){
            $increaseTransaction = $xdc->increaseAllowance($ownerAddress , $spenderAddress , $tokenAmount);
            $increaseTransactionId = $increaseTransaction->sign($ownerPrivateKey)->send();
            echo "Allowance increased by $tokenAmount successfully .the transaction id: $increaseTransactionId \n";
        }else{
            echo "Insufficient funds in a token to increase allowance. Your Current balance is: $balance-$allowance \n";
        }
    }

    // /**
    //  * transferFrom method.
    //  * By this method we can transfer token from spender to others behalf of owner.
    //  * Tokenamount input given by console.
    //  * Owner address input given by console.
    //  * Spender address input given by console.
    //  * Spender address privatekey input given by console.
    //  * To address input given by console.
    //  * Return hash value.
    //  */
    public function transferFrom(string $contractAddress,string $ownerAddress,string $spenderAddress,string $spenderPrivateKey,string $recieverAddress,float $tokenAmount){
        $xdc = $this->xdcConnection($contractAddress);
        $allowance = $xdc->allowance($ownerAddress,$spenderAddress);
        if ($tokenAmount <= $allowance){
            $transferTransaction = $xdc->transferFrom($spenderAddress,$ownerAddress,$recieverAddress, $tokenAmount);
            $transferTransactionId = $transferTransaction->sign($spenderPrivateKey)->send();
            echo "$tokenAmount Tokens transfered successfully. The transaction id is: $transferTransactionId \n";
        }else{
            echo "Insufficient allowance try again with different amount. Your current allowance is: $allowance \n";
        }
    }

    // /**
    //  * transferToken method.
    //  * By this method we can transfer token from one address to others.
    //  * Token amount input given by console.
    //  * From address input given by console.
    //  * From address private key input given by console.
    //  * To address input given by console.
    //  * Return hash value
    //  */
    public function transferToken(string $contractAddress,string $senderAddress,string $senderPrivateKey,string $recieverAddress,float $tokenAmount){
        $xdc = $this->xdcConnection($contractAddress);
        $balance = $xdc->balanceOf($senderAddress);
        if ($tokenAmount <= $balance){
            $transferTransaction = $xdc->transfer($senderAddress,$recieverAddress,$tokenAmount);
            $transferTransactionId= $transferTransaction->sign($senderPrivateKey)->send();
            echo "$tokenAmount Tokens transfered to $senderAddress successfully. Transaction id is: $transferTransactionId \n";
        }else{
            echo "Insufficient funds in a token try again with different amount. Your current balance is: $balance \n";
        }
    }

    // /**
    //  * TransferXDC Method.
    //  * By this method we can transfer XDC from one address to others.
    //  * Xdc amount input given by console.
    //  * From address input given by console.
    //  * From address privatekey input given by console.
    //  * To address input given by console.
    //  * Return hash value
    //  */
    public function transferXdc(string $contractAddress,string $senderAddress,string $senderPrivateKey,string $recieverAddress,float $xdcAmount){
        $xdc = $this->xdcConnection($contractAddress);
        $transferTransaction = $xdc->transferxdc($senderAddress,$recieverAddress ,$xdcAmount);
        $transferTransactionId = $transferTransaction->sign($senderPrivateKey)->send();
        echo " $xdcAmount XDC transfered to $recieverAddress successfully.Transfer id is: $transferTransactionId \n ";
    }
  
}

?>