# Phase 02: Database Schema & Data Mapping
Status: ⬜ Pending
Dependencies: Phase 01

## Objective
Phân tích cấu trúc DB hiện tại (các bảng fs_*) và thiết kế lược đồ (Schema) mới tương đương nhưng tối ưu hơn trên hệ thống quản trị mới.

## Requirements
### Functional
- [ ] Khảo sát toàn bộ DB cũ đang được sử dụng (Đặc biệt: Bảng tin tức, Dự án, Gói thầu, Người dùng).
- [ ] Thiết kế Content Types (Collections) trên hệ thống CMS mới.
- [ ] Định nghĩa các quan hệ (Relations) giữa các bảng (Ví dụ: Thể loại -> Bài viết, Tác giả -> Bài viết).

## Implementation Steps
1. [ ] Step 1 - Đọc và phân loại cấu trúc các bảng `fs_categories`, `fs_news`, `fs_products` v.v...
2. [ ] Step 2 - Lên danh sách các fields cần thiết lập trên CMS mới (Tiêu đề, Slug, Nội dung HTML, Ảnh đại diện, SEO Meta...).
3. [ ] Step 3 - Tạo cấu hình các Collection này trong Backend CMS.

## Test Criteria
- [ ] Có thể thêm thử 1 bài viết mẫu bằng tay từ CMS Admin Panel với đầy đủ trường dữ liệu.

---
Next Phase: Phase 03 - Backend CMS Setup
