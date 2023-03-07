# PICOCTF WRITE UP  
## 1. GET aHEAD
![](https://i.imgur.com/sNI8OiB.png)
sử dụng burp suite kiểm tra request của trang web thì thấy có sự khác biệt ở method khi ấn 1 trong 2 nút trên màn hình.


trong đó màu đỏ sẽ request với method ![](https://i.imgur.com/wDlqc6A.png)
màu xanh sẽ request với method là POST![](https://i.imgur.com/dLwyd0K.png)

Phương thức GET sẽ gửi request lên server thông qua URL nằm trên thanh địa chỉ của brower. Server sẽ nhận đường dẫn đó và phân tích trả về kết quả. GET không cần có request body
Phương thức Post là phương thức gửi dữ liệu đến server giúp bạn có thể thêm mới dữ liệu hoặc cập nhật dữ liệu đã có vào database. POST sẽ yêu cầu cần có request body
Nhận thấy điều đó khá liên quan đến đề bài là GET aHEAD. HEAD ở đây cũng là một Phương thức request giống như GET tuy nhiên điểm khác nhau ở đây là khi server response lại thì GET sẽ nhận được response body còn HEAD không nhận lại được response body.
![](https://i.imgur.com/7y0XLVG.png)
lúc này chúng ta đã nhận được flag là:picoCTF{r3j3ct_th3_du4l1ty_82880908}


## 2. cookie
![](https://i.imgur.com/I7msW45.png)
 sử dụng burp suiste để kiểm tra link đề bài cho.
 ![](https://i.imgur.com/LMc5Jaq.png)
 ta thấy ban đầu khi gửi request lên server không có cookie vậy nên response trả lại đã set cookie thành một giá trị =-1
 sau khi cookie trả về có giá trị là -1 thì chúng ta được trả về trang web ![](https://i.imgur.com/hs7Oo0E.png)
trong hệ boolean ta thấy -1 có giá trị là false. vậy thử thay giá trị cookie = 0 
![](https://i.imgur.com/v2DY6Ht.png)

lần này máy chủ dẫn chúng ta thấy web đã dẫn chúng ta đến url: /check. vậy ta chỉnh sửa request một chút để truy cập vào /check
![](https://i.imgur.com/VMCvMyI.png)

bây giờ giá giá trị hiển thị trên màn hình đã thay đổi, thử thêm cookie=1 
![](https://i.imgur.com/NxZphgh.png)

một lần nữa giá trị hiển thị thay đổi. vậy nên ta sử dụng burp suite để thay đổi giá trị của cookie và tìm flag. 
![](https://i.imgur.com/pVLqzcJ.png)
ở phần payload chúng ta sẽ sửa type thành number và một số thông tin như trên ![](https://i.imgur.com/q1k0ALl.png)
cuối cùng ở option chúng ta sẽ chọn từ khóa là picoCTF để mỗi khi attack burp suite sẽ tìm kiếm từ khóa và trả về số lần xuất hiện.

kết quả trả về ![](https://i.imgur.com/YKWHeR1.png)
ta thấy rằng ở lần thử cookie = 18 thấy picoCTF xuất hiện 2 lần. 1 lần ở cuối trang và lần còn lại khác những cookie khác vậy đây chắc chắn là flag. vậy thử cookie lại =18 ta được
![](https://i.imgur.com/8n50P1g.png)
 vậy flag là:picoCTF{3v3ry1_l0v3s_c00k135_94190c8a}

## 3 Insp3ct0r
![](https://i.imgur.com/E0VjVvF.png)
inspect website vào xem sources ở cả 3 phần. trong index, trong myjs.js mycss.css ở cuối sẽ có 3 phần flag nhỏ ghép cả 3 lại sẽ được flag
![](https://i.imgur.com/VJIIdTU.png)
![](https://i.imgur.com/U0tvtoL.png)
![](https://i.imgur.com/DwYNdwY.png)
 flag: picoCTF{tru3_d3t3ct1ve_0r_ju5t_lucky?832b0699}
 
 ## 4 Scavenger Hunt
 ![](https://i.imgur.com/lV27rx9.png)
đọc sources sẽ tìm được 2 phần của flag tại (index) và mycss.css
![](https://i.imgur.com/G5nIbwI.png)
![](https://i.imgur.com/jtoTVor.png)
myjs.js cho ta một gợi ý 
![](https://i.imgur.com/2ENcJy1.png)
làm thế nào để google không thể thu thập dữ liệu của mình được.
có một file là robots.txt một tệp văn bản có hướng dẫn dành cho rô-bốt công cụ tìm kiếm cho chúng biết trang nào chúng nên và không nên thu thập dữ liệu. Truy cập vào trang web trên ta sẽ có được phần 3 của flag và một hind nữa.
![](https://i.imgur.com/uiA3xqJ.png)
tìm hiểu thêm về apache server, ta thấy Apache sử dụng một tập tin .htaccess để ghi lại URL. sau đó thử truy cập vào apache server qua tập tin đó
![](https://i.imgur.com/vxdniUK.png)
![](https://i.imgur.com/2UZMIxP.png)
vậy là chúng ta đã được phần 4 của flag. gợi ý tiếp theo
Họ muốn lưu trữ nhiều thông tin ở trên mac, OSX sẽ sử dụng .ds_store để lưu trữ các thông tin đặc trưng của từng thư mục. 
Truy cập vào file đó 
![](https://i.imgur.com/fMMMELw.png)
ta sẽ có được phần cuối cùng của 
flag: picoCTF{th4ts_4_l0t_0f_pl4c3s_2_lO0k_d375c750}

## 5 Who are you?

## 6 Logon
![](https://i.imgur.com/QffXY7U.png)
![](https://i.imgur.com/b7j4bSL.png)
màn hình hiện ra một cửa sổ đăng nhập. đọc qua sources không có gì bất thường cả. đăng nhập thử với tên đăng nhập admin mật khẩu admin. đăng nhập thành công tuy nhiên chưa có mật khẩu tức là vấn đề không phải ở tên đăng nhập hay mật khẩu. cookie hiện lên mật khẩu tên đăng nhập và admin 
![](https://i.imgur.com/m6q4f6P.png)
set admin về true thử xem sao
![](https://i.imgur.com/Os464HM.png)
thế là ra flag: picoCTF{th3_c0nsp1r4cy_l1v3s_d1c24fef}

## 7 Login
![](https://i.imgur.com/OaLEw56.png)
![](https://i.imgur.com/aNAWiRk.png)
màn hình đăng nhập đơn giản. đọc thử sources thấy có một đoạn kiểm tra  tên đăng nhập và mật khẩu. Tuy nhiên đã bị mã hóa. 
![](https://i.imgur.com/7xnTTN1.png)
thử dịch mã ngược lại thì ta được kết quả như sau:
![](https://i.imgur.com/0cL22HJ.png)
![](https://i.imgur.com/1lwph9a.png)
vậy là ta đã có được flag: picoCTF{53rv3r_53rv3r_53rv3r_53rv3r_53rv3r}

## 8 Some Assembly Required 1
![](https://i.imgur.com/DJ1qnRT.png)
![](https://i.imgur.com/Q5bGPgd.png)
màn hình chỉ có một khung đơn giản để nhập flag. 
kiểm tra sources ta thấy ngay được flag: picoCTF{c733fda95299a16681f37b3ff09f901c}
![](https://i.imgur.com/b7p9Hxw.png)

## 9 Some Assembly Required 2
![](https://i.imgur.com/eKwxLW6.png)

màn hình cho phép nhập flag như Some Assembly Required 1. đọc thử sources ta lại thấy dòng flag đã được mã hóa
![](https://i.imgur.com/rN2r2CN.png)
sử dụng cybercheft giải mã là chúng ta đã được flag  
![](https://i.imgur.com/P2Id13h.png)
flag ở đây có thêm 2 kí tự khác lạ là =k có thể thấy nó là lí do khi chúng ta giải mã bằng các phương thức cũ không tìm ra. 
flag: picoCTF{6b247e06e36c9984b7500db8d992f3fe}





