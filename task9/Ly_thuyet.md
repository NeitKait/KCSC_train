# Task 9 Unrestricted-file-upload
## Định nghĩa: 
UFU là lỗ hổng khi máy chủ web cho phép người dùng tải tệp lên hệ thống tệp của nó mà không xác thực đầy đủ những thứ như tên, loại, nội dung hoặc kích thước của chúng. Việc không thực thi đúng các hạn chế đối với những điều này có thể có nghĩa là ngay cả chức năng tải lên hình ảnh cơ bản cũng có thể được sử dụng để tải lên các tệp tùy ý và có khả năng gây nguy hiểm. Điều này thậm chí có thể bao gồm các tệp tập lệnh phía máy chủ cho phép thực thi mã từ xa.

## Nguyên nhân:
Do hệ thống không kiểm soát các yếu tố như name, content, size, type, ... của các file tải lên, hoặc không giới hạn những khả năng của những file đã xâm nhập được vào hệ thống


* Tuy nhiên việc một hệ thống bị thả trôi thả nổi không có các giải pháp để kiểm duyệt nhằm ngăn chặn file upload vulnerabilities là rất thấp. Tình huống dễ bắt gặp hơn là khi hệ thống có triển khai giải pháp bảo vệ nhưng vì lí do gì đó vẫn tồn tại vấn đề cho phép attacker bypasss các phương án bảo vệ ví dụ như: Blacklist thiếu sót gặp 1 file độc lạ đội lốt extension lành tính. Hệ thống kiểm tra có thể bị thao túng bởi một số công cụ. Hoặc hệ thống đã triển khai kiểm soát chuẩn mực hệ thống nhưng quên kiểm soát ở một thành phần nào đó,...



## Hậu quả: 
Tùy thuộc vào việc hệ thống không kiểm soát yếu tố nào. Một số dạng hậu quả phổ biến như
* Với trường hợp filename (tên file), attacker có thể ghi đè vào các file hệ thống quan trọng;
* Với trường hợp filesize (kích thước file), attacker có thể chiếm dụng hết disk space (không gian đĩa) của hệ thống từ đó kích hoạt dạng tấn công Denial-of-service – DOS;
* Và trong kịch bản xấu nhất, hệ thống không thể kiểm duyệt được file type (loại file) dẫn đến cho phép attacker tuồn các thể loại độc hại (ví dụ như .php, .jsp) vào và thực thi như code. Với các server-side code file có thể hoạt động như web shell này, attacker có thể toàn quyền kiểm soát server.
* hacker còn có thể truy cập vào những thông tin nhạy cảm mà bình thường không thể truy cập được vào

## Cách ngăn ngừa:
Về cơ bản, để ngăn chặn file upload vulnerabilities thì bạn chỉ cần đừng mắc sai lầm trong quá trình triển khai các biện pháp kiểm soát và đặc biệt lưu ý các vấn đề sau:
* Kiểm tra file extension dựa trên whitelist (lưu ý, whitelist chứ không phải blacklist) để không phải dính đạn vì lỡ quên một (hoặc một số) thể loại file extension độc hại khác
* Soi kỹ filename coi có đám string mờ ám (ví dụ kiểu “…/”)
* Rename các file được upload để ngăn ngừa khả năng ghi đè vào các file hiện hữu trên hệ thống. Tuy nhiên việc chỉ đổi tên file là chưa đủ mà cần đổi cả phần extension của file hoặc gắn thêm phần mở rộng cố định vào file được tải lên.
* Chỉ cho phép upload file vào permanent filesystem của server sau khi quá trình kiểm tra sát khuẩn đã hoàn thành tốt đẹp
* Sử dụng các framework xử lý file upload chuẩn đã được kiểm tra thử nghiệm thay vì chơi hàng “nhà tự trồng” (trừ trường hợp bạn bắt buộc phải làm thế)

## Khai thác lỗ hổng:
https://viblo.asia/p/khai-thac-loi-unrestricted-file-upload-va-cac-ky-thuat-bypass-Ljy5VyNblra
### Client side
Một số ứng dụng web sử dụng javascript để ngăn chặn việc người dùng upload những file độc hại lên phía server. Ví dụ, đối với chức năng upload ảnh, người phát triển ứng dụng mong muốn người dùng chỉ upload các file ảnh có đuôi .jpg, .png, .gif. Do đó, anh ta sử dụng javascript để kiểm tra file được upload lên có phần đuôi là gì, nếu nó là file ảnh thì sẽ không có vấn đề gì, còn nếu là file độc hại ví dụ: .php, .exe thì sẽ pop-up thông báo file không được phép upload.

trong trường hợp này, attacker có thể dễ dàng sử dụng các kỹ thuật bypass việc chặn bằng javascript ở phía client bằng cách tắt javascript trên trình duyệt hoặc sử dụng các công cụ như burpsuite để bypass việc ngăn chặn.

### Extensions
Extensions là một hậu tố ở cuối một tập tin. Nó xuất hiện sau dấu chấm và thường dài từ hai đến bốn ký tự. Hiện nay có rất rất nhiều các loại extension khác nhau phù hợp với từng loại file hoặc mục đích sử dụng file khác nhau.
vậy nên hacker có thể tận dụng điều đó tạo ra những extension không bình thường nhằm bypass phần kiểm tra của website.


### Content-Type
Ứng dụng kiểm tra file upload lên có đúng content type yêu cầu không. Với file ảnh là: Content-Type: image/jpeg hoặc Content-Type: image/png. Lúc này hacker có thể bypass bằng cách chỉnh sửa content-type của file upload trước khi gửi lên server.
![](https://i.imgur.com/Y7eY4Gr.png)

## ROOT-ME
### 1. File upload - Double extensions
Trong phần upload em upload lên thử 1 ảnh png thì nhận được thông tin như sau: 
![](https://i.imgur.com/KCChfHF.png)
từ thông tin trên có thể thấy ảnh được lưu tại 1 file cách file rôt 3 file vậy nên cần phải back lại 3 file về file root và có quyền thì mới có thể truy cập vào .passwd
Có thể thấy trong repeater 
![](https://i.imgur.com/OcEE2Jp.png)
phần màu đỏ chính là phần mô tả của file png đó thành một đoạn payload php và filename thành shell.php ![](https://i.imgur.com/l1Jd1Rj.png)
web báo sai extension
![](https://i.imgur.com/TErOqnp.png)
đề bài gợi ý dùng double extension nên em sẽ thêm .png ở cuối filename. 
![](https://i.imgur.com/yH7xqDd.png)
vậy là đã upload lên thành công.
![](https://i.imgur.com/BeUlgTT.png)
ấn vào đã xem được thông tin của php.
thay đoạn payload php trên bằng payload sau:
`<?php
$output = shell_exec('cat ../../../.passwd');
echo "<pre>$output</pre>";
?>`
để lấy mật khẩu tại .passwd dưới dạng 1 chuỗi.
upload lại file lên rồi mở file shell đã gửi lên xem thì ta sẽ có được password:
![](https://i.imgur.com/MTId4aQ.png)


    
### 2. File upload - MIME 
làm tương tự bài double extension. 
tải 1 ảnh ngẫu nhiên lên. thay đổi mô tả của ảnh thành payload php sau: 
`<?php
$output = shell_exec('cat ../../../.passwd');
echo "<pre>$output</pre>";
?>`
đổi filename như mình muốn thêm extension thành .php cuối cùng là upload lại lên server và vào lại ảnh trong phần mình đã upload lấy flag thôi. 
![](https://i.imgur.com/YuCzCrZ.png)
