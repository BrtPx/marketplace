<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Patazone Email Template</title>
    <style type="text/css">
      body {
        margin: 0;
        background-color: #cccccc;
      }
      table {
        border-spacing: 0;
      }
      td {
        padding: 0;
      }
      img {
        border: 0;
      }
      .wrapper {
        width: 100%;
        table-layout: fixed;
        background-color: #cccccc;
        padding-bottom: 60px;
      }

      .main {
        background-color: #ffffff;
        margin: 0 auto;
        max-width: 600px;
        border-spacing: 0;
        font-family: sans-serif;
        color: #171a1e;
      }

      .two-columns {
        text-align: center;
        font-size: 0;
      }

      .two-columns .column {
        width: 100%;
        max-width: 300px;
        display: inline-block;
        vertical-align: top;
        text-align: center;
      }

      .three-columns {
        text-align: center;
        font-size: 0;
        padding: 15px 0 25px;
      }

      .three-columns .column {
        width: 100%;
        max-width: 200px;
        display: inline-block;
        vertical-align: top;
        text-align: center;
      }

      .three-columns .padding {
        padding: 15px;
      }

      .three-columns .content {
        font-size: 15px;
        padding: 0 5px;
      }

      .two-columns.last {
        padding: 15px 0;
      }

      .two-columns .padding {
        padding: 20px;
      }

      .two-columns .content {
        font-size: 15px;
        line-height: 20px;
        text-align: left;
      }

      .button {
        background-color: #ffffff;
        color: #171a1b;
        text-decoration: none;
        padding: 12px 20px;
        border-radius: 5px;
        font-weight: bold;
      }

      .button-dark {
        background-color: #171a1b;
        color: #ffffff;
        text-decoration: none;
        padding: 12px 20px;
        border-radius: 5px;
        font-weight: bold;
      }

      .button-dark:hover {
        background-color: #ee121a;
      }
    </style>
  </head>
  <body>
    <center class="wrapper" style="padding-bottom: 0 !important">
      <table class="main" width="100%">
        <!-- TOP BORDER -->
        <tr>
          <td height="8" style="background-color: #ee121a"></td>
        </tr>
        <!-- LOGO SECTION -->
        <tr>
          <td style="padding: 14px 0 4px">
            <table width="100%">
              <tr>
                <td class="two-columns">
                  <table class="column">
                    <tr>
                      <td style="padding: 0 62px">
                        <a href=""
                          ><img
                            src="https://patazone.co.ke/uploads/email/black_logo.jpg"
                            alt=""
                            width="180"
                            title="Patazone Marketplace"
                        /></a>
                      </td>
                    </tr>
                  </table>

                  <table class="column">
                    <tr>
                      <td style="padding: 10px 72px">
                        <a href="#"
                          ><img
                            src="https://patazone.co.ke/uploads/email/color_fb.png"
                            alt=""
                            style="padding-inline: 2px"
                            width="30"
                        /></a>
                        <a href="#"
                          ><img
                            src="https://patazone.co.ke/uploads/email/color_twitter.png"
                            style="padding-inline: 2px"
                            alt=""
                            width="30"
                        /></a>
                        <a href="#"
                          ><img
                            src="https://patazone.co.ke/uploads/email/color_linkedin.png"
                            style="padding-inline: 2px"
                            alt=""
                            width="30"
                        /></a>
                        <a href="#"
                          ><img
                            src="https://patazone.co.ke/uploads/email/color_ig.png"
                            style="padding-inline: 2px"
                            alt=""
                            width="30"
                        /></a>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
          </td>
        </tr>

        <tr>
          <td style="text-align: center">
            <p style="font-size: 26px; color: #ee121a">
              REGISTRATION SUCCESSFUL!
            </p>
            <p style="font-size: 26px; color: #747474">
              WELCOME!
            </p>
          </td>
        </tr>

        <tr>
          <td style="padding: 15px 0 50px">
            <table width="100%">
              <tr>
                <td style="text-align: left; padding: 15px">
                  <p style="font-size: 20px; font-weight: bold">Hi <?= $customer_name ?>,</p>
                  <p
                    style="
                      line-height: 23px;
                      font-size: 15px;
                      padding: 5px;
                      text-align: left;
                    "
                  >
                    Thank you for registering at Patazone , Kenya's largest
                    online shopping mall!<br /><br />
                    Shop for all your electronics, fashion, home appliances and
                    more and have the items shipped directly to your home or
                    office anywhere in Kenya. <br /><br />
                    Along with fantastic customer service, unbeatable prices,
                    free returns and quality products (that come with
                    warranties) Patazone offers multiple payment options where
                    you can opt for cash-on-delivery or pay via mobile money.
                    <br /><br />
                    Thank you for being a part of the Patazone family!
                    <br /><br />
                    Best Regards, <br />The Patazone Team
                  </p>
                </td>
              </tr>
            </table>
          </td>
        </tr>

        <!-- FOOTER SECTION -->

        <tr>
          <td style="background-color: #26292b">
            <table width="100%">
              <tr>
                <td
                  style="text-align: center; padding: 45px 20px; color: #ffffff"
                >
                  <a href=""
                    ><img
                      src="https://patazone.co.ke/uploads/email/white_logo.png"
                      alt=""
                      width="180"
                  /></a>
                  <p style="padding: 5px; color: #e6e6e6; font-size: small">
                    This message was sent to you from patazone marketplace.
                    Please do NOT reply to this as it is a system generated
                    email. For more information call +2547005888885 or email us
                    at <a href="info@patazone.co.ke">info@patazone.co.ke</a>
                  </p>
                  <p style="padding: 5px; font-size: x-small">
                    We are located at RNG Plaza Ronald Ngala Street Nairobi.
                  </p>
                  <a href="https://www.facebook.com/patazone"
                    ><img
                      src="https://patazone.co.ke/uploads/email/white-facebook.png"
                      alt=""
                      width="30"
                  /></a>
                  <a href="https://twitter.com/Patazon1"
                    ><img
                      src="https://patazone.co.ke/uploads/email/white-twitter.png"
                      alt=""
                      width="30"
                  /></a>
                  <a href="https://www.tiktok.com/@patazone"
                    ><img
                      src="https://patazone.co.ke/uploads/email/white-youtube.png"
                      alt=""
                      width="30"
                  /></a>
                  <a href="https://www.linkedin.com/company/patazone/"
                    ><img
                      src="https://patazone.co.ke/uploads/email/white-linkedin.png"
                      alt=""
                      width="30"
                  /></a>
                  <a href="https://www.instagram.com/pata.zon/"
                    ><img
                      src="https://patazone.co.ke/uploads/email/white-instagram.png"
                      alt=""
                      width="30"
                  /></a>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </center>
  </body>
</html>
