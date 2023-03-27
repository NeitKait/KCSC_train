# Lý thuyết

## XSS là gì: 
XSS là cross-site-scripting. Là một phương pháp tấn công cơ bản. Nó dựa trên việc thực thi HTML và JavaScript trên một trang web. Việc tấn công này có thể xảy ra khi xác nhận những lệnh ở các text-box, hoặc cũng có thể là trên thanh URL.

Lợi dụng lỗi này, kẻ tấn công có thể giả dạng người dùng nạn nhân, thực trích xuất, truy cập dữ liệu của người dùng. Nếu có quyền truy cập trong ứng dụng thì kẻ tấn công có thể toàn quyền kiểm soát chức năng và dữ liệu của ứng dụng. 

## XSS hoạt động thế nào
Khi xảy ra cá ứng dụng web không kiểm tra và sàng lạc đầu vào của người dùng đúng cách. Kẻ tấn công chèn vào đầu vào của người dùng, chẳng hạn như các form đăng nhập biểu mẫu, hoặc những câu lệnh độc hại. Khi người dùng vào trang web, thông tin độc hại sẽ được thực thi trên trình duyệt. Từ đó kẻ tấn công sẽ có thể khai thác thông tin của nạn nhân hoặc điều khiển trang web.

## Các dạng tấn công XSS:
* **Reflected XSS**: chỉ tồn tại ở html thời điểm đó 
Đây là loại xss đơn giản nhất. Xảy ra khi một ứng dụng nhận dữ liệu trong một yêu cầu HTTP và bao gồm dữ liệu đó trong phản hồi ngay lập tức theo cách không an toàn.
**VD** : Kẻ tấn công sẽ gửi mã độc thông qua URL, khi người dùng bấm vào thì kẻ tấn công sẽ có thể thực hiện truy xuất bất cứ dữ liệu nào mà người dùng có quyền truy cập.

* **Stored XSS**: tập lệnh độc hại đến từ db của web
phát sinh khi một ứng dụng nhận dữ liệu từ một nguồn không đáng tin cậy và bao gồm dữ liệu đó trong các phản hồi HTTP sau này theo cách không an toàn.
Dữ liệu được đề cập có thể được gửi tới ứng dụng thông qua các yêu cầu HTTP; Ví dụ: nhận xét về bài đăng trên blog, biệt hiệu của người dùng trong phòng trò chuyện hoặc chi tiết liên hệ trên đơn đặt hàng của khách hàng. Trong các trường hợp khác, dữ liệu có thể đến từ các nguồn không đáng tin cậy khác; Ví dụ: ứng dụng webmail hiển thị thư nhận được qua SMTP, ứng dụng tiếp thị hiển thị bài đăng trên mạng xã hội hoặc ứng dụng giám sát mạng hiển thị dữ liệu gói từ lưu lượng truy cập mạng.

* **DOM-based XSS**: lệnh độc hại đến từ máy của người dùng 
DOM-based XSS (còn được gọi là DOM XSS) phát sinh khi một ứng dụng chứa một số JavaScript phía máy khách xử lý dữ liệu từ một nguồn không đáng tin cậy theo cách không an toàn, thường bằng cách ghi dữ liệu trở lại DOM.

## Cách khai thác xss 
XSS có thể bị lợi dụng để:
* Mạo danh
* Truy cập, truy xuất thông tin. 
* Thực hiện mọi hành động mà người dùng có thể thực hiện
* Deface một trang web
* Tiêm trojan vào trang web

## cách khắc phục xss
1. filter đầu vào thông tin. sàng lọc từ dữ liệu nhập vào và URL. filter những kí tự đặc biệt.
2. Mã hóa thông tin dữ liệu trên trang web như tên người dùng, mật khẩu, thông tin tài khoản. Việc này giúp hạn chế thiệt hại khi bị khai thác.\
3. sử dụng các thư viện mã hóa và chống giả mạo thông tin.  Các thư viện này bao gồm các công cụ để xác thực dữ liệu, mã hóa dữ liệu và kiểm tra các ký tự đặc biệt và mã độc.
4. sử dụng các response header thích hợp: Để ngăn XSS trong các response HTTP chứa mã HTML hoặc JavaScript nào, có thể sử dụng các tiêu đề Content-Type và X-Content-Type-Options để đảm bảo rằng các trình duyệt diễn giải các response theo cách bạn muốn.
5. sử dụng CSP(content security policy): một cơ chế bảo mật cho phép các quản trị viên cấu hình chính sách bảo mật trên trang web để hạn chế hoặc ngăn chặn việc chèn vào các đoạn mã độc và các trang web có nguồn gốc không an toàn.







