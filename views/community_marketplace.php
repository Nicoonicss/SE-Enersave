<?php
$pageTitle = 'Marketplace';
$role = $_SESSION['user']['role'] ?? '';
$user = $_SESSION['user'] ?? null;
$username = $user['username'] ?? 'Community User';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Marketplace</title>
<style>
* {
    box-sizing: border-box;
}

body {
   margin: 0;
        font-family: Arial, Helvetica, sans-serif;
        background: #f7f7f7;
}

a {
    text-decoration: none;
    color: inherit;
}

img {
    max-width: 100%;
    border-radius: 12px 12px 0 0;
}

button {
    cursor: pointer;
}

.navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 40px;
    background: white;
    border-bottom: 1px solid #e0e0e0;
    position: sticky;
    top: 0;
    z-index: 10;
}

.nav-left {
    display: flex;
    align-items: center;
    gap: 20px;
    font-size: 15px;
}

.nav-left img {
    width: 30px;
}

.nav-left a,
.nav-right a {
    text-decoration: none;
    color: black;
    font-weight: 500;
}

.nav-right {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-left: auto;
    position: relative;
}

.nav-icon-btn {
    position: relative;
    background: none;
    border: none;
    cursor: pointer;
    padding: 5px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: transform 0.2s ease;
}

.nav-icon-btn:hover {
    transform: scale(1.1);
}

.nav-icon-btn img {
    width: 28px;
    height: 28px;
    object-fit: contain;
}

.icon-badge {
    position: absolute;
    top: -5px;
    right: -5px;
    background: #e53935;
    color: white;
    border-radius: 50%;
    width: 20px;
    height: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 11px;
    font-weight: 700;
}

.icon-badge.hidden {
    display: none;
}

.user-info-container {
    display: flex;
    align-items: center;
    gap: 8px;
    cursor: pointer;
    position: relative;
}

#currentUser {
    color: #333;
    font-weight: 500;
    font-size: 15px;
}

.nav-avatar {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: #ffcc00;
    cursor: pointer;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    font-size: 18px;
    color: white;
    font-weight: bold;
}

.nav-avatar::before {
    content: '';
    width: 16px;
    height: 16px;
    background: white;
    border-radius: 50% 50% 50% 50% / 60% 60% 40% 40%;
    position: absolute;
    top: 6px;
}

.nav-avatar::after {
    content: '';
    width: 20px;
    height: 12px;
    background: white;
    border-radius: 0 0 10px 10px;
    position: absolute;
    bottom: 4px;
    left: 50%;
    transform: translateX(-50%);
}

.avatar-dropdown {
    position: absolute;
    top: calc(100% + 8px);
    right: 0;
    background: white;
    border: 1px solid #e0e0e0;
    border-radius: 10px;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12), 0 2px 8px rgba(0, 0, 0, 0.08);
    min-width: 180px;
    opacity: 0;
    visibility: hidden;
    transform: translateY(-10px);
    transition: opacity 0.3s cubic-bezier(0.4, 0, 0.2, 1), visibility 0.3s cubic-bezier(0.4, 0, 0.2, 1), transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    z-index: 1000;
    pointer-events: none;
    overflow: hidden;
}

.user-info-container:hover {
    opacity: 0.8;
}

.avatar-dropdown.show {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
    pointer-events: auto;
}

.avatar-dropdown-item {
    display: flex;
    align-items: center;
    padding: 14px 18px;
    color: #333;
    text-decoration: none;
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    border: none;
    background: none;
    width: 100%;
    text-align: left;
    transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    border-bottom: 1px solid #f0f0f0;
}

.avatar-dropdown-item:last-child {
    border-bottom: none;
}

.avatar-dropdown-item:hover {
    background-color: #f8f9fa;
    color: #239c42;
    padding-left: 20px;
}

.avatar-dropdown-item:first-child {
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
}

.avatar-dropdown-item:last-child {
    border-bottom-left-radius: 10px;
    border-bottom-right-radius: 10px;
}

.avatar-dropdown-item.logout {
    color: #d32f2f;
    font-weight: 600;
}

.avatar-dropdown-item.logout:hover {
    background-color: #ffebee;
    color: #b71c1c;
    padding-left: 20px;
}

.brand-name {
    font-weight: 900;
    font-size: 18px;
}

header {
    padding: 20px 30px 10px 30px;
    position: relative;
    min-height: 80px;
}

header h1 {
    margin: 0;
    font-size: 24px;
    font-weight: 700;
}

header p {
    margin: 6px 0 0 0;
    font-size: 14px;
    color: #555;
}

.header-actions {
    position: absolute;
    bottom: 10px;
    right: 30px;
    display: flex;
    align-items: center;
    gap: 15px;
    flex-direction: row;
}

.header-icon-btn {
    position: relative;
    background: none;
    border: none;
    cursor: pointer;
    padding: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s ease;
    border-radius: 8px;
    height: 48px;
    width: 48px;
}

.header-icon-btn:hover {
    transform: scale(1.1);
    background-color: rgba(0, 0, 0, 0.05);
}

.header-icon-btn:active {
    transform: scale(0.95);
}

.header-icon-btn img {
    width: 32px;
    height: 32px;
    object-fit: contain;
    display: block;
    margin: 0;
    padding: 0;
}

#wishlistBtn {
    margin-top: 4px;
}

/* Cart and Wishlist Modals */
.cart-modal,
.wishlist-modal {
    display: none;
    position: fixed;
    background: white;
    border-radius: 12px;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15), 0 2px 8px rgba(0, 0, 0, 0.1);
    min-width: 350px;
    max-width: 420px;
    max-height: 600px;
    z-index: 10000;
    overflow: hidden;
    animation: slideDown 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    pointer-events: auto;
    margin-top: 0;
}

@media (max-width: 768px) {
    .cart-modal,
    .wishlist-modal {
        right: 20px !important;
        min-width: 300px;
        max-width: calc(100vw - 40px);
    }
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-8px) scale(0.95);
    }
    to {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}

.cart-modal.show,
.wishlist-modal.show {
    display: block;
}

.modal-header-section {
    padding: 16px 20px;
    border-bottom: 1px solid #e0e0e0;
    background: #f8f9fa;
}

.modal-header-section h3 {
    margin: 0;
    font-size: 18px;
    font-weight: 700;
    color: #333;
}

.modal-items-list {
    max-height: 350px;
    overflow-y: auto;
    padding: 10px 0;
    background: white;
    position: relative;
    z-index: 1;
}

.modal-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 20px;
    border-bottom: 1px solid #f0f0f0;
    transition: background-color 0.2s ease;
    position: relative;
}

.modal-item:hover {
    background-color: #f8f9fa;
}

.modal-item:last-child {
    border-bottom: none;
}

.modal-item-remove {
    position: absolute;
    top: 8px;
    right: 8px;
    background: none;
    border: none;
    color: #999;
    font-size: 18px;
    cursor: pointer;
    padding: 4px 8px;
    border-radius: 4px;
    transition: all 0.2s ease;
    line-height: 1;
    width: 28px;
    height: 28px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.modal-item-remove:hover {
    background-color: #ffebee;
    color: #e53935;
    transform: scale(1.1);
}

.modal-item-image {
    width: 50px;
    height: 50px;
    border-radius: 8px;
    object-fit: cover;
    background: #f0f0f0;
    flex-shrink: 0;
}

.modal-item-info {
    flex: 1;
    min-width: 0;
}

.modal-item-name {
    font-weight: 600;
    font-size: 14px;
    color: #333;
    margin: 0 0 4px 0;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.modal-item-price {
    font-size: 13px;
    color: #2e7d32;
    font-weight: 700;
    margin: 0;
}

.modal-item-supplier {
    font-size: 12px;
    color: #666;
    margin: 2px 0 0 0;
}

.modal-empty {
    padding: 40px 20px;
    text-align: center;
    color: #999;
    background: white;
    position: relative;
    z-index: 1;
}

.modal-empty-icon {
    font-size: 48px;
    margin-bottom: 10px;
}

.modal-empty-text {
    font-size: 14px;
}

.modal-footer {
    padding: 16px 20px;
    border-top: 1px solid #e0e0e0;
    background: #f8f9fa;
    display: flex;
    justify-content: center;
    align-items: center;
    font-weight: 600;
}

.modal-total {
    font-weight: 700;
    font-size: 16px;
    color: #333;
    display: flex;
    align-items: center;
    gap: 8px;
}

.modal-total-label {
    color: #666;
    font-size: 14px;
    font-weight: 500;
}

.filters-search {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 12px;
    padding: 0 30px 20px 30px;
}

.filters {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
    align-items: center;
}

.filter-btn {
    padding: 6px 14px;
    border-radius: 20px;
    border: none;
    font-size: 13px;
    font-weight: 600;
    background-color: #ddd;
    color: #444;
    transition: background-color 0.3s ease, color 0.3s ease;
    cursor: pointer;
}

.filter-btn.active {
    background-color: #98FB98;
    color: green;
}

.filter-btn:hover {
    background-color: #ccc;
}

.filter-btn.active:hover {
    background-color: #90EE90;
}
.sort-container {
    display: flex;
    align-items: center;
    gap: 8px;
}

.sort-label {
    font-size: 14px;
    font-weight: 600;
    color: #333;
    white-space: nowrap;
}

.sort-select {
    padding: 8px 32px 8px 12px;
    border-radius: 8px;
    border: 1.5px solid #ddd;
    font-size: 14px;
    font-weight: 600;
    background-color: white;
    color: #333;
    cursor: pointer;
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23333' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 10px center;
    transition: all 0.2s ease;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
}

.sort-select:hover {
    border-color: #2e7d32;
    box-shadow: 0 2px 6px rgba(46, 125, 50, 0.15);
}

.sort-select:focus {
    outline: none;
    border-color: #2e7d32;
    box-shadow: 0 0 0 3px rgba(46, 125, 50, 0.1);
}

.search-input {
    padding: 8px 14px;
    border-radius: 15px;
    border: 1px solid #ccc;
    font-size: 14px;
    color: #666;
    width: 250px;
}

.product-listings {
    padding: 0 30px 30px 30px;
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 0;
}

.product-card {
    background: #f8f8f8;
    border-radius: 0;
    box-shadow: 0 4px 12px rgb(0 0 0 / 0.05);
    padding-bottom: 12px;
    display: flex;
    flex-direction: column;
    transition: box-shadow 0.2s ease;
    margin: 0;
}

.product-card:hover {
    box-shadow: 0 8px 18px rgb(0 0 0 / 0.1);
}

.product-image {
    border-radius: 0;
    overflow: hidden;
    height: 130px;
    background: #ddd;
    display: flex;
    justify-content: center;
    align-items: center;
}

.product-image img {
    width: 215px; 
    height: auto; 
    object-fit: contain;
}

.product-info {
    padding: 12px 15px 0 15px;
    flex-grow: 1;
}

.product-info h3 {
    font-weight: 700;
    font-size: 15px;
    margin: 0 0 6px 0;
    line-height: 1.1;
}

.product-price {
    color: #2e7d32;
    font-weight: 700;
    margin: 0 0 5px 0;
    font-size: 14px;
}

.product-company {
    color: #666;
    font-size: 12px;
    margin-bottom: 8px;
}

.btn-group {
    display: flex;
    flex-direction: column;
    gap: 6px;
    padding: 0 15px 15px 15px;
}

.btn-buy {
    background: #2e7d32;
    color: white;
    border: none;
    font-weight: 700;
    padding: 8px 0;
    border-radius: 6px;
    cursor: pointer;
    transition: background-color 0.25s ease;
}

.btn-buy:hover {
    background: #1b4d1b;
}

.btn-add {
    background: #a5d6a7;
    color: #1b5e20;
    border: none;
    font-weight: 600;
    padding: 6px 0;
    border-radius: 6px;
    cursor: pointer;
    transition: background-color 0.25s ease;
}

.btn-add:hover {
    background: #81c784;
}

.btn-details {
    background: white;
    border: 1px solid #ccc;
    font-weight: 700;
    padding: 6px 0;
    border-radius: 6px;
    cursor: pointer;
    text-align: center;
    font-size: 13px;
    transition: background-color 0.2s ease, border-color 0.2s ease;
}

.btn-details-wishlist {
    display: flex;
    gap: 6px;
}

.btn-details {
    flex: 1; 
}

.btn-wishlist {
    width: 40px;      
    height: 40px;
    padding: 0;   
    font-size: 16px;
    background: white;
    border: 1.5px solid #d4a5a5;
    color: #e53935;
    border-radius: 8px;
    cursor: pointer;
    font-weight: 700;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    overflow: hidden;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
}

.btn-wishlist:hover {
    background-color: #ffe6e6;
    border-color: #c98a8a;
    transform: scale(1.05);
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
}

.btn-wishlist:active {
    transform: scale(0.95);
}

.btn-wishlist img {
    width: 20px;
    height: 20px;
    object-fit: contain;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    z-index: 1;
    filter: drop-shadow(0 1px 2px rgba(0, 0, 0, 0.1));
    opacity: 0.6;
}

.btn-wishlist.in-wishlist {
    background-color: #ffeef0;
    border-color: #e53935;
    box-shadow: 0 2px 6px rgba(229, 57, 53, 0.2);
}

.btn-wishlist.in-wishlist img {
    filter: drop-shadow(0 1px 2px rgba(0, 0, 0, 0.1));
    opacity: 1;
}

/* Pulse animation for heart button */
@keyframes heartPulse {
    0% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.2);
    }
    100% {
        transform: scale(1.1);
    }
}

@keyframes heartBounce {
    0%, 100% {
        transform: scale(1) translateY(0);
    }
    25% {
        transform: scale(1.3) translateY(-5px);
    }
    50% {
        transform: scale(1.1) translateY(0);
    }
    75% {
        transform: scale(1.2) translateY(-3px);
    }
}

.btn-wishlist.heart-animate {
    animation: heartPulse 0.6s cubic-bezier(0.4, 0, 0.2, 1);
}

.btn-wishlist.heart-bounce {
    animation: heartBounce 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55);
}

/* Toast notification */
.toast {
    position: fixed;
    bottom: 30px;
    right: 30px;
    background: linear-gradient(135deg, #e53935 0%, #c62828 100%);
    color: white;
    padding: 16px 24px;
    border-radius: 12px;
    box-shadow: 0 8px 24px rgba(229, 57, 53, 0.4);
    z-index: 10000;
    display: flex;
    align-items: center;
    gap: 12px;
    font-weight: 600;
    font-size: 14px;
    opacity: 0;
    transform: translateY(20px) scale(0.9);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    pointer-events: none;
    max-width: 300px;
}

.toast.show {
    opacity: 1;
    transform: translateY(0) scale(1);
    pointer-events: auto;
}

.toast-icon {
    font-size: 20px;
    animation: heartBounce 0.5s ease;
}

@keyframes toastSlideIn {
    from {
        opacity: 0;
        transform: translateX(100px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

.toast.show {
    animation: toastSlideIn 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.back-to-top {
    position: fixed;
    bottom: 30px;
    right: 30px;
    background: #2e7d32;
    color: white;
    font-weight: 700;
    border-radius: 20px;
    padding: 8px 16px;
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 14px;
    border: none;
    box-shadow: 0 3px 8px rgb(0 0 0 / 0.15);
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.back-to-top:hover {
    background: #1b4d1b;
}

/* Product Details Modal */
.product-modal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.5);
    animation: fadeIn 0.3s ease;
}

.product-modal.show {
    display: flex;
    align-items: center;
    justify-content: center;
}

@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

.modal-content {
    background-color: white;
    margin: auto;
    padding: 30px;
    border-radius: 12px;
    max-width: 600px;
    width: 90%;
    max-height: 90vh;
    overflow-y: auto;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
    animation: slideUp 0.3s ease;
}

@keyframes slideUp {
    from {
        transform: translateY(50px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    padding-bottom: 15px;
    border-bottom: 2px solid #e0e0e0;
}

.modal-header h2 {
    margin: 0;
    font-size: 24px;
    color: #333;
}

.close-modal {
    background: none;
    border: none;
    font-size: 28px;
    font-weight: bold;
    color: #999;
    cursor: pointer;
    padding: 0;
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    transition: all 0.2s ease;
}

.close-modal:hover {
    background-color: #f0f0f0;
    color: #333;
}

.modal-body {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.modal-product-image {
    width: 100%;
    max-height: 300px;
    object-fit: contain;
    border-radius: 8px;
    background: #f5f5f5;
    padding: 10px;
}

.modal-product-info {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.modal-info-row {
    display: flex;
    flex-direction: column;
    gap: 5px;
}

.modal-info-label {
    font-weight: 700;
    color: #666;
    font-size: 14px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.modal-info-value {
    font-size: 16px;
    color: #333;
}

.modal-product-price {
    font-size: 28px;
    font-weight: 700;
    color: #2e7d32;
}

.modal-product-description {
    line-height: 1.6;
    color: #555;
}

.modal-supplier {
    padding: 12px;
    background: #f8f9fa;
    border-radius: 8px;
    border-left: 4px solid #2e7d32;
}

/* Buy Now Modal Specific Styles */
.quantity-selector {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-top: 8px;
}

.quantity-btn {
    width: 40px;
    height: 40px;
    border: 2px solid #2e7d32;
    background: white;
    color: #2e7d32;
    font-size: 20px;
    font-weight: 700;
    border-radius: 8px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s ease;
}

.quantity-btn:hover {
    background: #2e7d32;
    color: white;
}

.quantity-btn:active {
    transform: scale(0.95);
}

#productQuantity {
    width: 80px;
    height: 40px;
    text-align: center;
    font-size: 18px;
    font-weight: 700;
    border: 2px solid #2e7d32;
    border-radius: 8px;
    background: #f8f9fa;
    color: #333;
    -moz-appearance: textfield;
}

#productQuantity::-webkit-outer-spin-button,
#productQuantity::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

.modal-actions {
    display: flex;
    gap: 12px;
    margin-top: 24px;
    padding-top: 20px;
    border-top: 2px solid #e0e0e0;
}

.btn-back-marketplace {
    flex: 1;
    padding: 14px 24px;
    background: #f5f5f5;
    color: #333;
    border: 2px solid #ddd;
    border-radius: 8px;
    font-weight: 600;
    font-size: 16px;
    cursor: pointer;
    transition: all 0.2s ease;
}

.btn-back-marketplace:hover {
    background: #e8e8e8;
    border-color: #bbb;
}

.btn-proceed-checkout {
    flex: 1;
    padding: 14px 24px;
    background: #2e7d32;
    color: white;
    border: none;
    border-radius: 8px;
    font-weight: 700;
    font-size: 16px;
    cursor: pointer;
    transition: all 0.2s ease;
    box-shadow: 0 2px 8px rgba(46, 125, 50, 0.3);
}

.btn-proceed-checkout:hover {
    background: #1b5e20;
    box-shadow: 0 4px 12px rgba(46, 125, 50, 0.4);
    transform: translateY(-2px);
}

.btn-proceed-checkout:active {
    transform: translateY(0);
}
</style>
</head>
<body>

<div class="navbar">
    <div class="nav-left">
        <img src="/images/Logo.png" alt="logo">
        <a href="/communityUserUI" class="brand-name"><strong>EnerSave</strong></a>
        <a href="/communityUserUI" id="homeDirect">Home</a>
        <a href="/communityMarketplaceUI" style="color: green;">Marketplace</a>
        <a href="/communityCrowdfundingUI" id="projectDirect">Projects</a>
        <a href="/communityLearnUI" id="learnDirect">Learn</a>
        <a href="/communityForumUI" id="forumDirect">Community</a>
    </div>

    <div class="nav-right">
        <div class="user-info-container" id="avatarDropdown">
            <span id="currentUser" data-username="<?php echo htmlspecialchars($username); ?>">Community: <?php echo htmlspecialchars($username); ?></span>
            <div class="nav-avatar"></div>
        </div>
        <div class="avatar-dropdown" id="avatarMenu">
            <a href="#" class="avatar-dropdown-item">Settings</a>
            <a href="/logout" class="avatar-dropdown-item logout">Logout</a>
        </div>
    </div>
</div>

<header>
  <h1>MARKETPLACE</h1>
  <p>Find affordable renewable energy solutions near you.</p>
  <div class="header-actions">
    <button class="header-icon-btn" id="cartBtn" title="Shopping Cart" style="position: relative;">
      <img src="/images/shoppingcart.png" alt="Shopping Cart">
      <span class="icon-badge hidden" id="cartBadge">0</span>
      <div class="cart-modal" id="cartModal">
        <div class="modal-header-section">
          <h3>Shopping Cart</h3>
        </div>
        <div class="modal-items-list" id="cartItemsList">
          <!-- Items will be populated here -->
        </div>
        <div class="modal-footer">
          <span class="modal-total">
            <span class="modal-total-label">Total:</span>
            <span id="cartTotalPrice">₱0</span>
          </span>
        </div>
      </div>
    </button>
    <button class="header-icon-btn" id="wishlistBtn" title="Wishlist" style="position: relative;">
      <img src="/images/finalwishlisticon.jpg" alt="Wishlist">
      <span class="icon-badge hidden" id="wishlistBadge">0</span>
      <div class="wishlist-modal" id="wishlistModal">
        <div class="modal-header-section">
          <h3>Wishlist</h3>
        </div>
        <div class="modal-items-list" id="wishlistItemsList">
          <!-- Items will be populated here -->
        </div>
        <div class="modal-footer">
          <span class="modal-total">
            <span class="modal-total-label">Total Items:</span>
            <span id="wishlistTotalCount">0</span>
          </span>
        </div>
      </div>
    </button>
  </div>
</header>

<div class="filters-search">
  <div class="filters">
    <button class="filter-btn">Solar</button>
    <button class="filter-btn">Wind</button>
    <button class="filter-btn">Hydro</button>
    <button class="filter-btn active">All</button>
    <div class="sort-container">
      <label class="sort-label">Sort by:</label>
      <select class="sort-select" aria-label="Sort products">
        <option value="name">Name</option>
        <option value="price">Price</option>
      </select>
    </div>
    <input class="search-input" type="search" placeholder="Search Product..." />
  </div>
</div>

<section class="product-listings">

  <?php for ($i = 0; $i < 18; $i++): ?>
  <article class="product-card">
  <div class="product-image">
    <img src="/images/product.png" alt="Solar Starter Kit" />
  </div>
  <div class="product-info">
    <h3>Solar Starter Kit</h3>
    <p class="product-price">₱5,000</p>
    <p class="product-company">GreenTech</p>
  </div>
  <div class="btn-group">
    <button class="btn-buy">Buy Now</button>
    <button class="btn-add">Add to Cart</button>
    <div class="btn-details-wishlist">
      <button class="btn-details">View Details</button>
      <button class="btn-wishlist" aria-label="Add to Wishlist">
        <img src="/images/finalwishlisticon.jpg" alt="Add to Wishlist" style="width: 18px; height: 18px; object-fit: contain;">
      </button>
    </div>
  </div>
</article>
  <?php endfor; ?>

</section>

<!-- Product Details Modal -->
<div id="productModal" class="product-modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2 id="modalProductName">Product Name</h2>
            <button class="close-modal" id="closeModal">&times;</button>
        </div>
        <div class="modal-body">
            <img id="modalProductImage" src="" alt="Product Image" class="modal-product-image">
            <div class="modal-product-info">
                <div class="modal-info-row">
                    <span class="modal-info-label">Price</span>
                    <span class="modal-product-price" id="modalProductPrice">₱0</span>
                </div>
                <div class="modal-info-row">
                    <span class="modal-info-label">Description</span>
                    <p class="modal-product-description" id="modalProductDescription">Product description will appear here.</p>
                </div>
                <div class="modal-info-row">
                    <span class="modal-info-label">Supplier</span>
                    <div class="modal-supplier" id="modalProductSupplier">Supplier name will appear here.</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Buy Now Modal -->
<div id="buyNowModal" class="product-modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2 id="buyModalProductName">Product Name</h2>
            <button class="close-modal" id="closeBuyModal">&times;</button>
        </div>
        <div class="modal-body">
            <img id="buyModalProductImage" src="" alt="Product Image" class="modal-product-image">
            <div class="modal-product-info">
                <div class="modal-info-row">
                    <span class="modal-info-label">Description</span>
                    <p class="modal-product-description" id="buyModalProductDescription">Product description will appear here.</p>
                </div>
                <div class="modal-info-row">
                    <span class="modal-info-label">Quantity</span>
                    <div class="quantity-selector">
                        <button class="quantity-btn" id="decreaseQuantity">−</button>
                        <input type="number" id="productQuantity" value="1" min="1" max="99">
                        <button class="quantity-btn" id="increaseQuantity">+</button>
                    </div>
                </div>
                <div class="modal-info-row">
                    <span class="modal-info-label">Price per unit</span>
                    <span class="modal-product-price" id="buyModalProductPrice">₱0</span>
                </div>
                <div class="modal-info-row">
                    <span class="modal-info-label">Total</span>
                    <span class="modal-product-price" id="buyModalTotalPrice">₱0</span>
                </div>
            </div>
            <div class="modal-actions">
                <button class="btn-back-marketplace" id="backToMarketplaceBtn">Back to Marketplace</button>
                <button class="btn-proceed-checkout" id="proceedCheckoutBtn">Proceed to Checkout</button>
            </div>
        </div>
    </div>
</div>

<button class="back-to-top" aria-label="Back to top">Back to Top ⬆️</button>
<script src="/navigationCommunity.js"></script>
<script src="/JavaScripts/avatarDropdown.js"></script>
<script>
// Product Details Modal Functionality
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('productModal');
    const closeModalBtn = document.getElementById('closeModal');
    const viewDetailsButtons = document.querySelectorAll('.btn-details');
    
    // Function to open modal with product data
    function openProductModal(productCard) {
        const productName = productCard.querySelector('.product-info h3').textContent.trim();
        const productPrice = productCard.querySelector('.product-price').textContent.trim();
        const productSupplier = productCard.querySelector('.product-company').textContent.trim();
        const productImage = productCard.querySelector('.product-image img').src;
        const productImageAlt = productCard.querySelector('.product-image img').alt || productName;
        
        // Generate description based on product name
        let productDescription = '';
        if (productName.toLowerCase().includes('solar')) {
            productDescription = 'A comprehensive solar energy starter kit perfect for small homes and off-grid applications. Includes high-efficiency solar panels, charge controller, battery storage system, and all necessary mounting hardware. Easy to install and maintain, this kit provides reliable renewable energy for your daily needs. Ideal for powering lights, small appliances, and electronic devices while reducing your carbon footprint.';
        } else if (productName.toLowerCase().includes('wind')) {
            productDescription = 'An efficient wind energy system designed for residential use. Features durable turbine blades, generator, and control system. Perfect for areas with consistent wind patterns. Helps reduce electricity costs and environmental impact.';
        } else if (productName.toLowerCase().includes('hydro')) {
            productDescription = 'A compact hydroelectric power solution for properties with water flow. Includes turbine, generator, and installation components. Provides clean, renewable energy from flowing water sources.';
        } else {
            productDescription = 'This is a high-quality renewable energy product designed to help you transition to clean energy. Perfect for residential and small commercial applications. Features reliable performance, easy installation, and long-lasting durability.';
        }
        
        // Populate modal
        document.getElementById('modalProductName').textContent = productName;
        document.getElementById('modalProductPrice').textContent = productPrice;
        document.getElementById('modalProductDescription').textContent = productDescription;
        document.getElementById('modalProductSupplier').textContent = productSupplier;
        document.getElementById('modalProductImage').src = productImage;
        document.getElementById('modalProductImage').alt = productImageAlt;
        
        // Show modal
        modal.classList.add('show');
        document.body.style.overflow = 'hidden';
    }
    
    // Function to close modal
    function closeProductModal() {
        modal.classList.remove('show');
        document.body.style.overflow = 'auto';
    }
    
    // Add event listeners to all "View Details" buttons
    viewDetailsButtons.forEach(button => {
        button.addEventListener('click', function() {
            const productCard = this.closest('.product-card');
            openProductModal(productCard);
        });
    });
    
    // Close modal when clicking the X button
    closeModalBtn.addEventListener('click', closeProductModal);
    
    // Close modal when clicking outside the modal content
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            closeProductModal();
        }
    });
    
    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && modal.classList.contains('show')) {
            closeProductModal();
        }
    });
});

// Buy Now Modal Functionality
document.addEventListener('DOMContentLoaded', function() {
    const buyNowModal = document.getElementById('buyNowModal');
    const closeBuyModalBtn = document.getElementById('closeBuyModal');
    const buyNowButtons = document.querySelectorAll('.btn-buy');
    const decreaseQuantityBtn = document.getElementById('decreaseQuantity');
    const increaseQuantityBtn = document.getElementById('increaseQuantity');
    const productQuantityInput = document.getElementById('productQuantity');
    const buyModalProductPrice = document.getElementById('buyModalProductPrice');
    const buyModalTotalPrice = document.getElementById('buyModalTotalPrice');
    const backToMarketplaceBtn = document.getElementById('backToMarketplaceBtn');
    const proceedCheckoutBtn = document.getElementById('proceedCheckoutBtn');
    
    let currentProductPrice = 0;
    
    // Function to extract price value from string (e.g., "₱5,000" -> 5000)
    function extractPrice(priceString) {
        const cleaned = priceString.replace(/[₱,]/g, '').trim();
        return parseFloat(cleaned) || 0;
    }
    
    // Function to format price
    function formatPrice(amount) {
        return '₱' + amount.toLocaleString('en-US');
    }
    
    // Function to calculate and update total
    function updateTotal() {
        const quantity = parseInt(productQuantityInput.value) || 1;
        const total = currentProductPrice * quantity;
        buyModalTotalPrice.textContent = formatPrice(total);
    }
    
    // Function to open Buy Now modal with product data
    function openBuyNowModal(productCard) {
        const productName = productCard.querySelector('.product-info h3').textContent.trim();
        const productPriceText = productCard.querySelector('.product-price').textContent.trim();
        const productImage = productCard.querySelector('.product-image img').src;
        const productImageAlt = productCard.querySelector('.product-image img').alt || productName;
        
        // Extract price value
        currentProductPrice = extractPrice(productPriceText);
        
        // Generate description based on product name
        let productDescription = '';
        if (productName.toLowerCase().includes('solar')) {
            productDescription = 'A comprehensive solar energy starter kit perfect for small homes and off-grid applications. Includes high-efficiency solar panels, charge controller, battery storage system, and all necessary mounting hardware. Easy to install and maintain, this kit provides reliable renewable energy for your daily needs. Ideal for powering lights, small appliances, and electronic devices while reducing your carbon footprint.';
        } else if (productName.toLowerCase().includes('wind')) {
            productDescription = 'An efficient wind energy system designed for residential use. Features durable turbine blades, generator, and control system. Perfect for areas with consistent wind patterns. Helps reduce electricity costs and environmental impact.';
        } else if (productName.toLowerCase().includes('hydro')) {
            productDescription = 'A compact hydroelectric power solution for properties with water flow. Includes turbine, generator, and installation components. Provides clean, renewable energy from flowing water sources.';
        } else {
            productDescription = 'A high-quality renewable energy solution designed to meet your power needs. This product features modern technology, reliable performance, and easy installation. Perfect for residential and small commercial applications.';
        }
        
        // Populate modal with product data
        document.getElementById('buyModalProductName').textContent = productName;
        document.getElementById('buyModalProductImage').src = productImage;
        document.getElementById('buyModalProductImage').alt = productImageAlt;
        document.getElementById('buyModalProductDescription').textContent = productDescription;
        buyModalProductPrice.textContent = productPriceText;
        
        // Reset quantity to 1
        productQuantityInput.value = 1;
        updateTotal();
        
        // Show modal
        buyNowModal.classList.add('show');
        document.body.style.overflow = 'hidden';
    }
    
    // Function to close Buy Now modal
    function closeBuyNowModal() {
        buyNowModal.classList.remove('show');
        document.body.style.overflow = 'auto';
    }
    
    // Add event listeners to all "Buy Now" buttons
    buyNowButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            const productCard = this.closest('.product-card');
            if (productCard) {
                openBuyNowModal(productCard);
            }
        });
    });
    
    // Quantity controls
    decreaseQuantityBtn.addEventListener('click', function() {
        const currentValue = parseInt(productQuantityInput.value) || 1;
        if (currentValue > 1) {
            productQuantityInput.value = currentValue - 1;
            updateTotal();
        }
    });
    
    increaseQuantityBtn.addEventListener('click', function() {
        const currentValue = parseInt(productQuantityInput.value) || 1;
        const maxValue = parseInt(productQuantityInput.max) || 99;
        if (currentValue < maxValue) {
            productQuantityInput.value = currentValue + 1;
            updateTotal();
        }
    });
    
    // Handle direct input typing
    productQuantityInput.addEventListener('input', function() {
        let value = parseInt(this.value) || 1;
        const minValue = parseInt(this.min) || 1;
        const maxValue = parseInt(this.max) || 99;
        
        // Clamp value to min/max bounds
        if (value < minValue) {
            value = minValue;
        } else if (value > maxValue) {
            value = maxValue;
        }
        
        this.value = value;
        updateTotal();
    });
    
    // Handle blur event to ensure valid value when user leaves the field
    productQuantityInput.addEventListener('blur', function() {
        let value = parseInt(this.value) || 1;
        const minValue = parseInt(this.min) || 1;
        const maxValue = parseInt(this.max) || 99;
        
        if (value < minValue) {
            value = minValue;
        } else if (value > maxValue) {
            value = maxValue;
        }
        
        this.value = value;
        updateTotal();
    });
    
    // Back to Marketplace button
    backToMarketplaceBtn.addEventListener('click', function() {
        closeBuyNowModal();
        // Redirect to marketplace page
        window.location.href = '/communityMarketplaceUI';
    });
    
    // Proceed to Checkout button (placeholder for now)
    proceedCheckoutBtn.addEventListener('click', function() {
        // TODO: Implement checkout functionality
        alert('Checkout functionality will be implemented here');
    });
    
    // Close modal when clicking the X button
    closeBuyModalBtn.addEventListener('click', closeBuyNowModal);
    
    // Close modal when clicking outside the modal content
    buyNowModal.addEventListener('click', function(e) {
        if (e.target === buyNowModal) {
            closeBuyNowModal();
        }
    });
    
    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && buyNowModal.classList.contains('show')) {
            closeBuyNowModal();
        }
    });
});

// Shopping Cart and Wishlist Functionality
document.addEventListener('DOMContentLoaded', function() {
    // Get current user identifier
    const currentUserElement = document.getElementById('currentUser');
    const currentUsername = currentUserElement ? currentUserElement.getAttribute('data-username') || 'default' : 'default';
    
    // User-specific localStorage keys
    const cartKey = `shoppingCart_${currentUsername}`;
    const wishlistKey = `wishlist_${currentUsername}`;
    const lastUserKey = 'lastLoggedInUser';
    
    // Check if user has changed and clear old data if needed
    const lastUser = localStorage.getItem(lastUserKey);
    if (lastUser && lastUser !== currentUsername) {
        // Clear previous user's data
        const oldCartKey = `shoppingCart_${lastUser}`;
        const oldWishlistKey = `wishlist_${lastUser}`;
        localStorage.removeItem(oldCartKey);
        localStorage.removeItem(oldWishlistKey);
    }
    
    // Store current user
    localStorage.setItem(lastUserKey, currentUsername);
    
    // Initialize cart and wishlist from localStorage for current user
    let cart = JSON.parse(localStorage.getItem(cartKey)) || [];
    let wishlist = JSON.parse(localStorage.getItem(wishlistKey)) || [];
    
    const cartBadge = document.getElementById('cartBadge');
    const wishlistBadge = document.getElementById('wishlistBadge');
    const cartBtn = document.getElementById('cartBtn');
    const wishlistBtn = document.getElementById('wishlistBtn');
    
    // Function to update badge counts
    function updateBadges() {
        // Refresh from localStorage to ensure we have the latest data
        cart = JSON.parse(localStorage.getItem(cartKey)) || [];
        wishlist = JSON.parse(localStorage.getItem(wishlistKey)) || [];
        
        const cartCount = cart.length;
        const wishlistCount = wishlist.length;
        
        if (cartCount > 0) {
            cartBadge.textContent = cartCount;
            cartBadge.classList.remove('hidden');
        } else {
            cartBadge.classList.add('hidden');
        }
        
        if (wishlistCount > 0) {
            wishlistBadge.textContent = wishlistCount;
            wishlistBadge.classList.remove('hidden');
        } else {
            wishlistBadge.classList.add('hidden');
        }
        
        // Update modals if they are currently visible
        const cartModal = document.getElementById('cartModal');
        const wishlistModal = document.getElementById('wishlistModal');
        if (cartModal && cartModal.classList.contains('show')) {
            renderCartModal();
        }
        if (wishlistModal && wishlistModal.classList.contains('show')) {
            renderWishlistModal();
        }
    }
    
    // Function to get product data from card
    function getProductData(productCard) {
        // Get all product cards to find a stable index
        const allProductCards = Array.from(document.querySelectorAll('.product-card'));
        const productIndex = allProductCards.indexOf(productCard);
        
        // Get product info
        const name = productCard.querySelector('.product-info h3')?.textContent.trim() || '';
        const price = productCard.querySelector('.product-price')?.textContent.trim() || '';
        const supplier = productCard.querySelector('.product-company')?.textContent.trim() || '';
        const image = productCard.querySelector('.product-image img')?.src || '';
        
        // Create a unique ID based on product data and position
        // This allows same products in different positions to be added separately
        const uniqueId = `${name}-${price}-${supplier}-${productIndex}`;
        
        return {
            id: uniqueId,
            name: name,
            price: price,
            supplier: supplier,
            image: image,
            imageAlt: productCard.querySelector('.product-image img')?.alt || ''
        };
    }
    
    // Store clicked buttons to track which specific buttons are highlighted
    // Maps buttonId to wishlist item index
    const clickedWishlistButtons = new Map();
    
    // Add to Cart functionality - allow duplicates
    const addToCartButtons = document.querySelectorAll('.btn-add');
    addToCartButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Refresh cart from localStorage first to ensure we have the latest data
            cart = JSON.parse(localStorage.getItem(cartKey)) || [];
            
            const productCard = this.closest('.product-card');
            const product = getProductData(productCard);
            
            // Always add to cart (allow duplicates)
            cart.push(product);
            localStorage.setItem(cartKey, JSON.stringify(cart));
            updateBadges();
            
            // Show feedback
            const originalText = button.textContent;
            button.textContent = 'Added!';
            button.style.background = '#4caf50';
            setTimeout(() => {
                button.textContent = originalText;
                button.style.background = '';
            }, 1500);
        });
    });
    
    // Create toast notification element
    function createToast(message, isRemoval = false) {
        // Remove existing toast if any
        const existingToast = document.querySelector('.toast');
        if (existingToast) {
            existingToast.remove();
        }
        
        const toast = document.createElement('div');
        toast.className = 'toast';
        if (isRemoval) {
            toast.style.background = 'linear-gradient(135deg, #666 0%, #444 100%)';
        }
        toast.innerHTML = `
            <span class="toast-icon">${isRemoval ? '💔' : '❤️'}</span>
            <span>${message}</span>
        `;
        document.body.appendChild(toast);
        
        // Show toast
        setTimeout(() => {
            toast.classList.add('show');
        }, 10);
        
        // Hide and remove toast after 3 seconds
        setTimeout(() => {
            toast.classList.remove('show');
            setTimeout(() => {
                toast.remove();
            }, 300);
        }, 3000);
    }
    
    // Add to/Remove from Wishlist functionality - toggle with enhanced animations
    const wishlistButtons = document.querySelectorAll('.btn-wishlist');
    wishlistButtons.forEach((button, index) => {
        // Create unique identifier for each button
        const buttonId = `wishlist-btn-${index}`;
        button.setAttribute('data-button-id', buttonId);
        
        button.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            // Refresh wishlist from localStorage first
            wishlist = JSON.parse(localStorage.getItem(wishlistKey)) || [];
            
            const productCard = this.closest('.product-card');
            const product = getProductData(productCard);
            
            // Helper function to normalize image paths for comparison
            function normalizeImagePath(path) {
                if (!path) return '';
                return path.replace(/^https?:\/\/[^\/]+/, '').replace(/\\/g, '/').toLowerCase();
            }
            
            // Helper function to compare products
            function productsMatch(product1, product2) {
                // If products have IDs, use them for exact matching (same product in same position)
                if (product1.id && product2.id) {
                    return product1.id === product2.id;
                }
                
                // Otherwise, use the existing matching logic for products without IDs
                const img1 = normalizeImagePath(product1.image || '');
                const img2 = normalizeImagePath(product2.image || '');
                
                return product1.name === product2.name && 
                       product1.price === product2.price &&
                       (product1.supplier === product2.supplier || product1.brand === product2.supplier || product2.supplier === product1.supplier || product2.brand === product1.supplier) &&
                       (img1 === img2 || img1.endsWith(img2) || img2.endsWith(img1));
            }
            
            // Check if this specific product instance is in the wishlist
            const productInWishlist = wishlist.findIndex(item => {
                // First try to match by ID if available (exact same product card)
                if (product.id && item.id) {
                    return item.id === product.id;
                }
                // Otherwise use productsMatch for backward compatibility
                return productsMatch(item, product);
            });
            
            // Check if button is already highlighted
            const isHighlighted = button.classList.contains('in-wishlist') || (productInWishlist !== -1);
            
            if (isHighlighted && productInWishlist !== -1) {
                // Remove from wishlist
                wishlist.splice(productInWishlist, 1);
                localStorage.setItem(wishlistKey, JSON.stringify(wishlist));
                
                // Refresh wishlist from localStorage to ensure consistency
                wishlist = JSON.parse(localStorage.getItem(wishlistKey)) || [];
                
                // Update badges (this will also update the header badge)
                updateBadges();
                
                // Rebuild highlights to sync all buttons (this will remove highlights for removed items)
                restoreWishlistHighlights();
                
                // Show removal animation
                button.style.transform = 'scale(0.9)';
                setTimeout(() => {
                    button.style.transform = '';
                }, 300);
                
                // Haptic feedback (if supported)
                if (navigator.vibrate) {
                    navigator.vibrate(30);
                }
            } else {
                // Add to wishlist
                wishlist.push(product);
                localStorage.setItem(wishlistKey, JSON.stringify(wishlist));
                updateBadges();
                
                // Highlight THIS specific button that was clicked
                button.classList.add('in-wishlist');
                
                // Rebuild highlights to sync all buttons
                restoreWishlistHighlights();
                button.classList.add('heart-animate');
                
                // Remove animation class after animation completes
                setTimeout(() => {
                    button.classList.remove('heart-animate');
                }, 600);
                
                // Add bounce effect
                setTimeout(() => {
                    button.classList.add('heart-bounce');
                    setTimeout(() => {
                        button.classList.remove('heart-bounce');
                    }, 500);
                }, 300);
                
                // Haptic feedback (if supported)
                if (navigator.vibrate) {
                    navigator.vibrate(50);
                }
            }
        });
    });
    
    // Function to render cart items in modal
    function renderCartModal() {
        // Refresh cart from localStorage to ensure we have the latest data
        try {
            cart = JSON.parse(localStorage.getItem(cartKey)) || [];
        } catch (e) {
            console.error('Error parsing cart from localStorage:', e);
            cart = [];
        }
        
        const cartItemsList = document.getElementById('cartItemsList');
        const cartTotalPrice = document.getElementById('cartTotalPrice');
        const cartModal = document.getElementById('cartModal');
        
        if (!cartItemsList || !cartTotalPrice) {
            console.error('Cart modal elements not found');
            return;
        }
        
        if (cart.length === 0) {
            // Clear all content first
            cartItemsList.innerHTML = '';
            cartItemsList.innerHTML = `
                <div class="modal-empty">
                    <div class="modal-empty-icon">🛒</div>
                    <div class="modal-empty-text">Your cart is empty!</div>
                </div>
            `;
            cartTotalPrice.textContent = '₱0';
            // Hide footer when empty
            const cartFooter = cartModal.querySelector('.modal-footer');
            if (cartFooter) {
                cartFooter.style.display = 'none';
            }
            // Ensure modal has solid background
            if (cartModal) {
                cartModal.style.background = 'white';
                cartModal.style.overflow = 'hidden';
            }
        } else {
            // Clear any existing content first
            cartItemsList.innerHTML = '';
            
            // Render each cart item
            cart.forEach((item, index) => {
                if (!item || !item.name) {
                    console.warn('Invalid cart item at index', index, item);
                    return;
                }
                
                const itemElement = document.createElement('div');
                itemElement.className = 'modal-item';
                itemElement.setAttribute('data-cart-index', index);
                itemElement.innerHTML = `
                    <img src="${item.image || '/images/product.png'}" alt="${item.imageAlt || item.name}" class="modal-item-image" onerror="this.src='/images/product.png'">
                    <div class="modal-item-info">
                        <div class="modal-item-name">${item.name || 'Unknown Product'}</div>
                        <div class="modal-item-price">${item.price || '₱0'}</div>
                        <div class="modal-item-supplier">${item.supplier || 'Unknown Supplier'}</div>
                    </div>
                    <button class="modal-item-remove" data-cart-index="${index}" title="Remove from cart">×</button>
                `;
                cartItemsList.appendChild(itemElement);
            });
            
            // Add remove button event listeners
            cartItemsList.querySelectorAll('.modal-item-remove').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    // Refresh cart from localStorage first
                    try {
                        cart = JSON.parse(localStorage.getItem(cartKey)) || [];
                    } catch (e) {
                        console.error('Error parsing cart from localStorage:', e);
                        cart = [];
                    }
                    const index = parseInt(this.getAttribute('data-cart-index'));
                    if (index >= 0 && index < cart.length) {
                        cart.splice(index, 1);
                        localStorage.setItem(cartKey, JSON.stringify(cart));
                        updateBadges();
                        renderCartModal();
                    }
                });
            });
            
            // Calculate total price
            const total = cart.reduce((sum, item) => {
                if (!item || !item.price) return sum;
                const price = parseFloat(item.price.replace(/[₱,]/g, '')) || 0;
                return sum + price;
            }, 0);
            cartTotalPrice.textContent = `₱${total.toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;
            
            // Show footer when cart has items
            const cartFooter = cartModal.querySelector('.modal-footer');
            if (cartFooter) {
                cartFooter.style.display = 'flex';
            }
        }
    }
    
    // Function to render wishlist items in modal
    function renderWishlistModal() {
        // Refresh wishlist from localStorage to ensure we have the latest data
        wishlist = JSON.parse(localStorage.getItem(wishlistKey)) || [];
        
        const wishlistItemsList = document.getElementById('wishlistItemsList');
        const wishlistTotalCount = document.getElementById('wishlistTotalCount');
        const wishlistModal = document.getElementById('wishlistModal');
        
        if (wishlist.length === 0) {
            // Clear all content first
            wishlistItemsList.innerHTML = '';
            wishlistItemsList.innerHTML = `
                <div class="modal-empty">
                    <div class="modal-empty-icon">❤️</div>
                    <div class="modal-empty-text">Your wishlist is empty!</div>
                </div>
            `;
            wishlistTotalCount.textContent = '0';
            // Hide footer when empty
            const wishlistFooter = wishlistModal.querySelector('.modal-footer');
            if (wishlistFooter) {
                wishlistFooter.style.display = 'none';
            }
            // Ensure modal has solid background
            if (wishlistModal) {
                wishlistModal.style.background = 'white';
                wishlistModal.style.overflow = 'hidden';
            }
        } else {
            wishlistItemsList.innerHTML = wishlist.map((item, index) => `
                <div class="modal-item" data-wishlist-index="${index}">
                    <img src="${item.image}" alt="${item.imageAlt}" class="modal-item-image" onerror="this.src='/images/product.png'">
                    <div class="modal-item-info">
                        <div class="modal-item-name">${item.name}</div>
                        <div class="modal-item-price">${item.price}</div>
                        <div class="modal-item-supplier">${item.supplier}</div>
                    </div>
                    <button class="modal-item-remove" data-wishlist-index="${index}" title="Remove from wishlist">×</button>
                </div>
            `).join('');
            
            // Add remove button event listeners
            wishlistItemsList.querySelectorAll('.modal-item-remove').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const index = parseInt(this.getAttribute('data-wishlist-index'));
                    const removedItem = wishlist[index];
                    wishlist.splice(index, 1);
                    localStorage.setItem(wishlistKey, JSON.stringify(wishlist));
                    
                    // Refresh wishlist from localStorage to ensure consistency
                    wishlist = JSON.parse(localStorage.getItem(wishlistKey)) || [];
                    
                    // Update badges (this will update the header badge count)
                    updateBadges();
                    
                    // Rebuild highlights to sync all buttons properly (this will remove highlights for removed items)
                    restoreWishlistHighlights();
                    
                    // Re-render the modal (updateBadges might have already done this, but ensure it's done)
                    renderWishlistModal();
                });
            });
            
            wishlistTotalCount.textContent = wishlist.length;
            
            // Show footer when wishlist has items
            const wishlistFooter = wishlistModal.querySelector('.modal-footer');
            if (wishlistFooter) {
                wishlistFooter.style.display = 'flex';
            }
        }
    }
    
    // Calculate modal position based on button position
    function updateModalPosition(button, modal) {
        const buttonRect = button.getBoundingClientRect();
        
        // Position modal directly below the button with a small gap
        const topPosition = buttonRect.bottom + 8;
        // Align to the right edge of the clicked button
        const rightPosition = window.innerWidth - buttonRect.right;
        
        modal.style.top = `${topPosition}px`;
        modal.style.right = `${rightPosition}px`;
    }
    
    // Cart button click handler - show modal
    cartBtn.addEventListener('click', function(e) {
        e.stopPropagation();
        const cartModal = document.getElementById('cartModal');
        updateModalPosition(cartBtn, cartModal);
        renderCartModal();
        cartModal.classList.toggle('show');
        
        // Close other modals
        const wishlistModal = document.getElementById('wishlistModal');
        wishlistModal.classList.remove('show');
    });
    
    // Wishlist button click handler - show modal
    wishlistBtn.addEventListener('click', function(e) {
        e.stopPropagation();
        const wishlistModal = document.getElementById('wishlistModal');
        updateModalPosition(wishlistBtn, wishlistModal);
        renderWishlistModal();
        wishlistModal.classList.toggle('show');
        
        // Close other modals
        const cartModal = document.getElementById('cartModal');
        cartModal.classList.remove('show');
    });
    
    // Update modal position on scroll and resize
    let scrollTimeout;
    window.addEventListener('scroll', function() {
        clearTimeout(scrollTimeout);
        scrollTimeout = setTimeout(function() {
            const cartModal = document.getElementById('cartModal');
            const wishlistModal = document.getElementById('wishlistModal');
            if (cartModal.classList.contains('show')) {
                updateModalPosition(cartBtn, cartModal);
            }
            if (wishlistModal.classList.contains('show')) {
                updateModalPosition(wishlistBtn, wishlistModal);
            }
        }, 10);
    });
    
    window.addEventListener('resize', function() {
        const cartModal = document.getElementById('cartModal');
        const wishlistModal = document.getElementById('wishlistModal');
        if (cartModal.classList.contains('show')) {
            updateModalPosition(cartBtn, cartModal);
        }
        if (wishlistModal.classList.contains('show')) {
            updateModalPosition(wishlistBtn, wishlistModal);
        }
    });
    
    // Close modals when clicking outside
    document.addEventListener('click', function(e) {
        const cartModal = document.getElementById('cartModal');
        const wishlistModal = document.getElementById('wishlistModal');
        
        if (!cartBtn.contains(e.target) && !cartModal.contains(e.target)) {
            cartModal.classList.remove('show');
        }
        
        if (!wishlistBtn.contains(e.target) && !wishlistModal.contains(e.target)) {
            wishlistModal.classList.remove('show');
        }
    });
    
    // Close modals on Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            const cartModal = document.getElementById('cartModal');
            const wishlistModal = document.getElementById('wishlistModal');
            cartModal.classList.remove('show');
            wishlistModal.classList.remove('show');
        }
    });
    
    // Helper function to normalize image paths for comparison
    function normalizeImagePath(path) {
        if (!path) return '';
        // Remove protocol, domain, and normalize slashes
        return path.replace(/^https?:\/\/[^\/]+/, '').replace(/\\/g, '/').toLowerCase();
    }
    
    // Helper function to compare products
    function productsMatch(product1, product2) {
        // If products have IDs, use them for exact matching (same product in same position)
        if (product1.id && product2.id) {
            return product1.id === product2.id;
        }
        
        // Otherwise, use the existing matching logic for products without IDs
        const img1 = normalizeImagePath(product1.image || '');
        const img2 = normalizeImagePath(product2.image || '');
        
        return product1.name === product2.name && 
               product1.price === product2.price &&
               (product1.supplier === product2.supplier || product1.brand === product2.supplier || product2.supplier === product1.supplier || product2.brand === product1.supplier) &&
               (img1 === img2 || img1.endsWith(img2) || img2.endsWith(img1));
    }
    
    // Function to restore highlighted buttons on page load
    function restoreWishlistHighlights() {
        // Refresh wishlist from localStorage
        try {
            wishlist = JSON.parse(localStorage.getItem(wishlistKey)) || [];
        } catch (e) {
            console.error('Error parsing wishlist from localStorage:', e);
            wishlist = [];
        }
        
        // Re-query buttons to ensure we have fresh DOM elements
        const allWishlistButtons = document.querySelectorAll('.btn-wishlist');
        
        // Clear all highlights first
        allWishlistButtons.forEach(button => {
            button.classList.remove('in-wishlist');
        });
        clickedWishlistButtons.clear();
        
        // Track which wishlist items have been matched to buttons
        const matchedWishlistIndices = new Set();
        
        allWishlistButtons.forEach((button, index) => {
            const buttonId = `wishlist-btn-${index}`;
            button.setAttribute('data-button-id', buttonId);
            
            const productCard = button.closest('.product-card');
            if (!productCard) return;
            
            const product = getProductData(productCard);
            
            // Find matching wishlist item by comparing full product data
            for (let i = 0; i < wishlist.length; i++) {
                if (matchedWishlistIndices.has(i)) continue;
                
                const wishlistItem = wishlist[i];
                // Use improved matching function
                if (productsMatch(wishlistItem, product)) {
                    // Match this button to this wishlist item
                    button.classList.add('in-wishlist');
                    clickedWishlistButtons.set(buttonId, i);
                    matchedWishlistIndices.add(i);
                    break; // Move to next button
                }
            }
        });
    }
    
    // Initialize badges and restore highlights on page load
    // Use setTimeout to ensure DOM is fully rendered
    updateBadges();
    
    // Restore highlights after a short delay to ensure all elements are rendered
    setTimeout(() => {
        restoreWishlistHighlights();
    }, 200);
    
    // Also restore highlights when window loads (in case DOMContentLoaded fired too early)
    window.addEventListener('load', function() {
        setTimeout(() => {
            restoreWishlistHighlights();
        }, 100);
    });
});

// Search Functionality - Will be integrated with filter functionality
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.querySelector('.search-input');
    
    if (searchInput) {
        // Also handle search on Enter key (prevent form submission if it's in a form)
        searchInput.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
            }
        });
    }
});

// Filter Functionality
document.addEventListener('DOMContentLoaded', function() {
    const filterButtons = document.querySelectorAll('.filter-btn');
    const productCards = document.querySelectorAll('.product-card');
    let currentFilter = 'All';
    
    // Function to check if product matches filter
    function matchesFilter(card, category) {
        if (category === 'All') {
            return true;
        }
        
        const productName = card.querySelector('.product-info h3')?.textContent.trim().toLowerCase() || '';
        const productAlt = card.querySelector('.product-image img')?.alt.toLowerCase() || '';
        const searchableText = `${productName} ${productAlt}`;
        
        if (category === 'Solar') {
            return searchableText.includes('solar');
        } else if (category === 'Wind') {
            return searchableText.includes('wind');
        } else if (category === 'Hydro') {
            return searchableText.includes('hydro');
        }
        
        return false;
    }
    
    // Function to apply both filter and search
    function applyFilters() {
        const searchInput = document.querySelector('.search-input');
        const searchTerm = searchInput ? searchInput.value.toLowerCase().trim() : '';
        
        productCards.forEach(card => {
            // Check filter match
            const filterMatch = matchesFilter(card, currentFilter);
            
            // Check search match
            let searchMatch = true;
            if (searchTerm) {
                const productName = card.querySelector('.product-info h3')?.textContent.toLowerCase() || '';
                const productPrice = card.querySelector('.product-price')?.textContent.toLowerCase() || '';
                const productCompany = card.querySelector('.product-company')?.textContent.toLowerCase() || '';
                const productAlt = card.querySelector('.product-image img')?.alt.toLowerCase() || '';
                const searchableText = `${productName} ${productPrice} ${productCompany} ${productAlt}`;
                searchMatch = searchableText.includes(searchTerm);
            }
            
            // Show if both filter and search match
            if (filterMatch && searchMatch) {
                card.style.display = '';
            } else {
                card.style.display = 'none';
            }
        });
    }
    
    // Add click event listeners to filter buttons
    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Remove active class from all buttons
            filterButtons.forEach(btn => {
                btn.classList.remove('active');
            });
            
            // Add active class to clicked button
            this.classList.add('active');
            
            // Get filter category from button text
            currentFilter = this.textContent.trim();
            
            // Apply filters
            applyFilters();
        });
    });
    
    // Update search to also consider filter
    const searchInput = document.querySelector('.search-input');
    if (searchInput) {
        const originalSearchHandler = searchInput.oninput;
        searchInput.addEventListener('input', function() {
            applyFilters();
        });
    }
    
    // Initialize with "All" filter
    applyFilters();
});

// Sort Functionality
document.addEventListener('DOMContentLoaded', function() {
    const sortSelect = document.querySelector('.sort-select');
    const productListings = document.querySelector('.product-listings');
    
    if (sortSelect && productListings) {
        sortSelect.addEventListener('change', function() {
            const sortBy = this.value;
            const productCards = Array.from(document.querySelectorAll('.product-card'));
            
            // Sort products
            productCards.sort((a, b) => {
                if (sortBy === 'name') {
                    const nameA = a.querySelector('.product-info h3')?.textContent.trim().toLowerCase() || '';
                    const nameB = b.querySelector('.product-info h3')?.textContent.trim().toLowerCase() || '';
                    return nameA.localeCompare(nameB);
                } else if (sortBy === 'price') {
                    const priceA = parseFloat(a.querySelector('.product-price')?.textContent.replace(/[₱,]/g, '') || '0');
                    const priceB = parseFloat(b.querySelector('.product-price')?.textContent.replace(/[₱,]/g, '') || '0');
                    return priceA - priceB;
                }
                return 0;
            });
            
            // Clear and re-append sorted products
            productCards.forEach(card => {
                productListings.appendChild(card);
            });
        });
    }
});

// Back to Top Button Functionality
document.addEventListener('DOMContentLoaded', function() {
    const backToTopBtn = document.querySelector('.back-to-top');
    
    if (backToTopBtn) {
        // Scroll to top when button is clicked
        backToTopBtn.addEventListener('click', function(e) {
            e.preventDefault();
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
        
        // Show/hide button based on scroll position
        window.addEventListener('scroll', function() {
            if (window.pageYOffset > 300) {
                backToTopBtn.style.display = 'flex';
            } else {
                backToTopBtn.style.display = 'none';
            }
        });
        
        // Initially hide the button
        backToTopBtn.style.display = 'none';
    }
});
</script>
</body>
</html>

