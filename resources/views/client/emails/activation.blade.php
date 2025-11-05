<!doctype html>
<html>
  <head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Kích hoạt tài khoản của bạn</title>
    <style>
      img { border: none; -ms-interpolation-mode: bicubic; max-width: 100%; }
      body { background-color: #f6f6f6; font-family: sans-serif; font-size: 14px; line-height: 1.4; margin: 0; padding: 0; }
      table { border-collapse: separate; width: 100%; }
      table td { font-family: sans-serif; font-size: 14px; vertical-align: top; }
      .body { background-color: #f6f6f6; width: 100%; }
      .container { display: block; margin: 0 auto !important; max-width: 580px; padding: 10px; width: 580px; }
      .content { box-sizing: border-box; display: block; margin: 0 auto; max-width: 580px; padding: 10px; }
      .main { background: #ffffff; border-radius: 3px; width: 100%; }
      .wrapper { box-sizing: border-box; padding: 20px; }
      .content-block { padding-bottom: 10px; padding-top: 10px; }
      .footer { clear: both; margin-top: 10px; text-align: center; width: 100%; }
      .footer td, .footer p, .footer span, .footer a { color: #999999; font-size: 12px; text-align: center; }
      h1, h2, h3, h4 { color: #000; font-weight: 400; line-height: 1.4; margin: 0 0 30px; }
      h1 { font-size: 35px; font-weight: 300; text-align: center; text-transform: capitalize; }
      p, ul, ol { font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0 0 15px; }
      a { color: #3498db; text-decoration: underline; }
      .btn { box-sizing: border-box; width: 100%; }
      .btn > tbody > tr > td { padding-bottom: 15px; }
      .btn table { width: auto; }
      .btn table td { background-color: #ffffff; border-radius: 5px; text-align: center; }
      .btn a { background-color: #ffffff; border: solid 1px #3498db; border-radius: 5px; color: #3498db; font-size: 14px; font-weight: bold; padding: 12px 25px; text-decoration: none; }
      .btn-primary table td { background-color: #3498db; }
      .btn-primary a { background-color: #3498db; border-color: #3498db; color: #ffffff; }
      .btn-primary a:hover { background-color: #34495e !important; border-color: #34495e !important; }
    </style>
  </head>
  <body>
    <table border="0" cellpadding="0" cellspacing="0" class="body">
      <tr>
        <td>&nbsp;</td>
        <td class="container">
          <div class="content">
            <!-- BẮT ĐẦU EMAIL CHÍNH -->
            <table class="main">
              <tr>
                <td class="wrapper">
                  <table border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td>
                        <p>Xin chào <b>{{ $user->name }}</b>,</p>
                        <p>Cảm ơn bạn đã đăng ký tài khoản tại website của chúng tôi. Vì lý do bảo mật, vui lòng xác minh tài khoản bằng cách nhấn vào nút bên dưới.</p>
                        <table border="0" cellpadding="0" cellspacing="0" class="btn btn-primary">
                          <tbody>
                            <tr>
                              <td align="left">
                                <table border="0" cellpadding="0" cellspacing="0">
                                  <tbody>
                                    <tr>
                                      <td>
                                        <a href="{{ url('/activate/' .$token) }}" target="_blank">KÍCH HOẠT TÀI KHOẢN</a>
                                      </td>
                                    </tr>
                                  </tbody>
                                </table>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                        <p>Trân trọng,<br>Đội ngũ Veggie Website.</p>
                        <p><b>Lưu ý:</b> Vui lòng không trả lời email này. Thư này được gửi từ địa chỉ thông báo tự động và không nhận phản hồi. Nếu bạn không đăng ký tài khoản, có thể người khác đã nhập nhầm địa chỉ email của bạn. Mọi thắc mắc vui lòng liên hệ quản trị viên.</p>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
            <!-- KẾT THÚC EMAIL CHÍNH -->

            <!-- FOOTER -->
            <div class="footer">
              <table border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td class="content-block">
                    <br> Không muốn nhận email này nữa? <a href="#">Hủy đăng ký</a>.
                  </td>
                </tr>
                <tr>
                  <td class="content-block powered-by">
                    Bản quyền &copy; 2025 Veggie Website. Mọi quyền được bảo lưu.
                  </td>
                </tr>
              </table>
            </div>
          </div>
        </td>
        <td>&nbsp;</td>
      </tr>
    </table>
  </body>
</html>
