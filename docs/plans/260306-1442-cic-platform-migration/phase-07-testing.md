# Phase 07: Testing & Go-Live (Deployment)
Status: ⬜ Pending
Dependencies: ALL PHASES

## Objective
Kiểm thử toàn diện lại hiệu năng, bảo mật và Deploy public ra Internet.

## Requirements
### Functional
- [ ] Pentest nhẹ (Thử chèn script/sql vào form liên hệ, param).
- [ ] Đẩy code Frontend lên Vercel. Trỏ domain `cic.com.vn`.
- [ ] Cài đặt SSL/HTTPS (Let's encrypt/Cloudflare).

## Implementation Steps
1. [ ] Step 1 - Bật tính năng bảo trì ở trang cũ 1 buổi tối.
2. [ ] Step 2 - Run lại Script Migration lần chót (lấy Data của 1 vài ngày cuối).
3. [ ] Step 3 - Change A Record của DNS domain về máy chủ mới.

## Test Criteria
- [ ] Truy cập `https://cic.com.vn` ra trang Next.js mới. Mọi thứ hoạt động hoàn hảo.
- [ ] Check console F12 không bị mã độc, không có file .php rác nào chạy ngầm. 
