# ROOT ME WRITE UP


## +HTTP - IP restriction bypass
![](https://i.imgur.com/DdlDqIg.png)
trang chủ chỉ có màn hình đăng nhập và yêu cầu đăng nhập bằng kết nối lan
![](https://i.imgur.com/pA325rd.png)
vậy gửi request sử dụng X-Forwarded-For để để lừa server mình truy cập tại địa chỉ lan tại địa chỉ 192.168.0.2 là địa chỉ của mạng lan
![](https://i.imgur.com/meCxstD.png)
vậy là chúng ta đã có password: Ip_$po0Fing

## +HTTP - User-agent
![](https://i.imgur.com/JlV2Aag.png)
![](https://i.imgur.com/YfaoLWg.png)
 
 trang web yêu cầu chúng ta là vậy chỉ cần lừa server chúng ta là admin bằng cách gửi request header user-agent: admin
 ![](https://i.imgur.com/PBhF7Ak.png)
 vậy là chúng ta có password: rr$Li9%L34qd1AAe27

## +HTTP – Headers
![](https://i.imgur.com/0ekb2eK.png)
họ bảo mội dung không phải phần duy nhất của response. vậy nên ta sẽ xem thử xem web sẽ request và response thế nào.
![](https://i.imgur.com/900bkJZ.png)
ta thấy có một dòng khá khả nghi là Header-RootMe-Admin: none
gửi lại request với Header-RootMe-Admin: True thử
![](https://i.imgur.com/hrU46Mw.png)
vậy là chúng ta có password: HeadersMayBeUseful
## +HTTP – POST
![](https://i.imgur.com/j83J2SI.png)
![](https://i.imgur.com/HRxf21I.png)
thử xem qua sources xem có gì không. không thấy có gì đặc biệt cả. Cho vào buurp suite request và response thế nào. 
![](https://i.imgur.com/8wUTmuX.png)
 ta thấy rằng mỗi lần chúng ta ấn give a try nó sẽ random 1 số từ 0 - 1000001
 vậy tức là chúng ta có tỉ lệ rất thấp dường như =0 để thắng. 
 sau khi ấn give a try thì trình duyệt sẽ gửi một request ![](https://i.imgur.com/PuZ5vuC.png)
phần cuối có điểm số. thử thay đổi điểm số đó xem sao
![](https://i.imgur.com/rtpwapO.png)
 tuyệt vời. vậy là chúng ta đã có được flag: H7tp_h4s_N0_s3Cr37S_F0r_y0U

## HTTP - Open redirect
![](https://i.imgur.com/BTKDU2i.png)
trang chủ có 3 nút đơn giản. xem qua sources không có gì đặc biệt. ấn vào facebook xem request và response. 
![](https://i.imgur.com/h9y3qfd.png)
 ta thấy rằng sau khi ta ấn vào facebook thì trình duyệt sẽ gửi một request lên server với một đường dẫn url.
 thử thay đổi đường dẫn url thì ta thấy web bảo rằng ![](https://i.imgur.com/xinvAB2.png)
sai hash. vậy đoạn đường dẫn h là đoạn nội dung đã được mã hóa
 tìm kiếm mã hóa ấy trên google ta thấy được đó là dữ liệu đã được mã hóa md5 ![](https://i.imgur.com/3zsS7qM.png)
![](https://i.imgur.com/G8VWJ4F.png)
 nội dung là https://facebook.com
 vậy là trình duyệt sẽ gửi một đường dẫn url và một mã hóa url của đường dẫn đó lên server. 
 vậy mã hóa đường dẫn https://youtube.com
theo md5 rồi thay cho đường dẫn kia thử. 
![](https://i.imgur.com/taHjp1w.png)

vậy là chúng ta có flag: e6f8a530811d5a479812d7b82fc1a5c5
## HTTP - Improper redirect
![](https://i.imgur.com/Y4FP7nI.png)
đọc thử sources không thấy gì. thử đăng nhập admin/admin xem được gì không và xem request với response luôn.
![](https://i.imgur.com/JPBe9GZ.png)
ta không thấy gì đặc biệt ở response và request. đề bài muốn chúng ta chuyển hướng. vậy nên thử chuyển hướng đích đến tin gửi đi từ request, xóa login.php đi. ![](https://i.imgur.com/D93kWuV.png)
vậy là chúng ta có flag. rất ăn may nhưng em vẫn chưa hiểu kĩ đoạn này lắm. 
flag: ExecutionAfterRedirectIsBad

## Client side: HTML - 
![](https://i.imgur.com/ZRfokkc.png)
không thể ấn được. vậy nên đọc sources thử. ![](https://i.imgur.com/3QcrouS.png)

phát hiện ngay ra ô nhập text và nút submit bị disabled. xóa thử 2 thuộc tính này đi. 
![](https://i.imgur.com/GqEM0cj.png)
vậy là có thể nhập được tên vào
nhập thử tên là admin 
![](https://i.imgur.com/gi5DlDy.png)
vậy là chúng ta đã thành công
flag: HTMLCantStopYou
