# Phase 04: Frontend UI (Clone & Polish)
Status: ⬜ Pending
Dependencies: Phase 03

## Objective
Xây dựng lại toàn bộ giao diện phía Client bằng Next.js + TailwindCSS, giữ nguyên luồng UX hiện tại của CIC CMS nhưng tối ưu về tốc độ, layout mượt mà hơn và thêm Dark Mode nếu có thể.

## Requirements
### Functional
- [ ] Tái tạo layout Header / Footer / Menu điều hướng.
- [ ] Trang Chủ: Tối ưu Slideshow, danh sách Tin tức nổi bật.
- [ ] Trang Danh mục Tin tức: Tích hợp Pagination / Load More.
- [ ] Trang Chi tiết Bài viết: Hiển thị nội dung HTML sạch, Breadcrumbs.
- [ ] Trang Sản phẩm/Giải pháp: Hiển thị danh mục Giải pháp công nghệ.

### Non-Functional
- [ ] SSR / SSG để Google index tức thì (Lighthouse score > 90/100).
- [ ] Responsive UI 100% trên Mobile, Tablet.
- [ ] Loading Skeleton khi đợi API.

## Implementation Steps
1. [ ] Step 1 - Cấu hình Layout tổng thể, Header, Footer trên Next.js App Router (thư mục app/layout.tsx).
2. [ ] Step 2 - Tạo các Router cần thiết: /, /tin-tuc, /giai-phap-cong-nghe, /[slug].
3. [ ] Step 3 - Kết nối API (GraphQL/REST) từ Backend (Phase 03) để đổ dữ liệu động ra View.
4. [ ] Step 4 - Xử lý SEO Meta Titles & Description động cho mỗi trang.

## Test Criteria
- [ ] Truy cập `/tin-tuc/bai-viet-test` hiển thị đúng nội dung từ Backend.
- [ ] Xem Source HTML (Ctrl+U) thấy đầy đủ thẻ Meta và Content thay vì trang rỗng (như React cũ).

---
Next Phase: Phase 05 - Data Migration
