<html>
  <head>
    <title>PayForm</title>
    <script src="http://localhost/billpay/assets/cashfree-sdk.js" type="text/javascript"></script>
  </head>
  <body>
    <script type="text/javascript">  
      var payCard = null;
      var payBank = null;
      var payWallet = null;
      var payUpi = null;

      (function() {
        var paymentToken = "<INSERT_PAYMENT_TOKEN_VALUE_HERE>";

        var data = {};
        data.appId = "MTA2OTkyMDE1ODE0NDIyNTExNjYjIz";
        data.orderId = "CFTEST00001";
        data.orderAmount = 100;
        data.customerName = "John Doe";
        data.customerPhone = "9900012345";
        data.customerEmail = "jdoe@mail.com";
        data.notifyUrl = "https://www.test.com/notify";
        data.orderNote = "Extra Info";
        data.pc = "";

        data.paymentToken = paymentToken;
        
        var config = {};
        config.layout = {};
        config.checkout = "transparent";
        config.mode = "TEST";
        var response = CashFree.init(config);

        if (response.status != "OK") {
          // Handle error in initializing 
        }

        var postPaymentCallback = function (event) {
          console.log(event);
          // Callback method that handles Payment 
          if (event.name == "PAYMENT_RESPONSE" && event.status == "SUCCESS") {
            // Handle Success 
          } 
          else if (event.name == "PAYMENT_RESPONSE" && event.status == "CANCELLED") {
            // Handle Cancelled
          } 
          else if (event.name == "PAYMENT_RESPONSE" && event.status == "FAILED") {
            // Handle Failed
          } 
          else if (event.name == "VALIDATION_ERROR") { 
            // Incorrect inputs
          }
        };

        payCard = function() {
          data.paymentOption = "card";
          data.card = {};
          data.card.number = document.getElementById("card-num").value; 
          data.card.expiryMonth = document.getElementById("card-mm").value;
          data.card.expiryYear = document.getElementById("card-yyyy").value;
          data.card.holder = document.getElementById("card-name").value;
          data.card.cvv = document.getElementById("card-cvv").value;

          CashFree.paySeamless(data, postPaymentCallback);
          return false;
        };

        payBank = function() {
          data.paymentOption = "nb";
          data.nb = {};
          data.nb.code = document.getElementById("bank-code").value;

          CashFree.paySeamless(data, postPaymentCallback);
          return false;
        };

        payWallet = function() {
          data.paymentOption = "wallet";
          data.wallet = {};
          data.wallet.code = document.getElementById("wallet-code").value;

          CashFree.paySeamless(data, postPaymentCallback);
          return false;
        };

        payUpi = function() {
          data.paymentOption = "upi";
          data.upi = {};
          data.upi.vpa = document.getElementById("upi-vpa").value;

          CashFree.paySeamless(data, postPaymentCallback);
          return false;
        };

      })();

    </script>
    <h1>Payment Form</h1>
    <table border = "3" cellpadding = "5" cellspacing = "5">
      <tr>
        <th>Type</th>
        <th>Details</th>
        <th>Submit</th>
      </tr>
      <tr>
        <td>Cards</td>
        <td>
          <form>
            <p>Card Number: <input type="text" id="card-num"/>
            CVV:<input type="text" id="card-cvv"/></p>
            <p>MM:<input type="text" id="card-mm"/>
            YYYY:<input type="text" id="card-yyyy"/></p>
            Name:<input type="text" id="card-name"/>
          </form>
        </td>
        <td>
          <button onclick="payCard()">Pay with Card</button>      
        </td>
      </tr>
      <tr>
        <td>Net Banking</td>
        <td>
          Select Bank: 
          <select id="bank-code">
            <option value="3333">TEST Bank</option>
            <option value="3003">Axis Bank</option>
            <option value="3028">IndusInd Bank</option>
            <option value="3057">Vijaya Bank</option>
          </select>
        </td>
        <td>
          <button onclick="payBank()">Pay with Net Banking</button>      
        </td>
      </tr>
      <tr>
        <td>Wallet</td>
        <td>
          Select Wallet: 
          <select id="wallet-code">
            <option value="4001">FreeCharge</option>
            <option value="4002">MobiKwik</option>
            <option value="4003">Ola Money</option>
          </select>
        </td>
        <td>
          <button onclick="payWallet()">Pay with Wallet</button>      
        </td>
      </tr>
      <tr>
        <td>UPI</td>
        <td>
          Your UPI VPA: 
          <input type="text" id="upi-vpa"/>
        </td>
        <td>
          <button onclick="payUpi()">Pay with UPI</button>      
        </td>
      </tr>
    </table>
  </body>
</html>