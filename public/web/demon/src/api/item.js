import request from '@/utils/request'
export function deleteItem (itemId) {
  return request({
    url: 'item/remove',
    method: 'get',
    params: itemId
  })
}
export function addItem (item) {
  return request({
    url: 'item/add',
    method: 'post',
    params: item
  })
}
export function query (query) {
  return request({
    url: '/item/query',
    method: 'get',
    params: query
  })
}
