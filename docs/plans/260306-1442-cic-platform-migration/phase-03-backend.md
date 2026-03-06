# Phase 03: Backend CMS Setup & API
Status: ⬜ Pending
Dependencies: Phase 02

## Objective
Thiết lập quyền truy cập API (Roles & Permissions), cấu hình Media Library (xử lý hình ảnh/file), và đảm bảo Backend sẵn sàng cung cấp dữ liệu cho Frontend.

## Requirements
### Functional
- [ ] Cấu hình Upload Provider (Lưu ổ cứng local hoặc S3/GCS tùy nhu cầu).
- [ ] Cấu hình Image Optimization (Tự resize ảnh lớn ra các size nhỏ, tạo định dạng WebP).
- [ ] Cấu hình Role "Public" (Chỉ cho phép GET dữ liệu tin tức) & "Authenticated" (Đăng tin).
- [ ] Tạo API endpoint hỗ trợ tìm kiếm và phân trang (Pagination).

## Implementation Steps
1. [ ] Step 1 - Cài đặt và cấu hình plugin Upload.
2. [ ] Step 2 - Tạo Admin user và phân quyền.
3. [ ] Step 3 - Viết custom Controller/Resolver (nếu dùng GraphQL) để trả về đúng cấu trúc yêu cầu.

## Test Criteria
- [ ] Postman REST API request đến danh sách tin tức trả về đúng JSON Schema (kèm hình ảnh).
- [ ] Request bị chặn (401/403) nếu cố tình POST/PUT dữ liệu từ tài khoản Public.

---
Next Phase: Phase 04 - Frontend UI
