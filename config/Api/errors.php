<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 2018/8/9
 * Time: 下午3:46
 */
return [
    'required' => [
        'code' => 1,
        'message' => '%s is required',
    ],
    'invalid_key' => [
        'code' => 2,
        'message' => 'key is invalid',
    ],
    'invalid_hash' => [
        'code' => 3,
        'message' => 'hash is invalid',
    ],
    'player_not_found' => [
        'code' => 4,
        'message' => 'player not found',
    ],
    'method_not_allowed' => [
        'code' => 5,
        'message' => '%s is not allowed',
    ],
    'query_time_out_of_range' => [
        'code' => 6,
        'message' => 'query time range out of limit',
    ],
    'internal_server_error' => [
        'code' => 7,
        'message' => 'internal server error',
    ],
    'player_is_offline' => [
        'code' => 8,
        'message' => 'player is offline',
    ],
    'player_is_online' => [
        'code' => 9,
        'message' => 'player is online',
    ],
    'service_not_available' => [
        'code' => 10,
        'message' => 'service not available',
    ],
    'params_not_valid' => [
        'code' => 11,
        'message' => '%s is invalid',
    ],
    'gametype_not_found' => [
        'code' => 12,
        'message' => 'gameType:%s not found',
    ],
    'accout_length_between_4_20' => [
        'code' => 13,
        'message' => 'account length between 4 - 20',
    ],
    'nickname_length_between_1_20' => [
        'code' => 14,
        'message' => 'nickname length between 1 - 20',
    ],
    'enable_setting_is_invalid' => [
        'code' => 15,
        'message' => 'enable setting is invalid',
    ],
    'mode_setting_is_invalid' => [
        'code' => 16,
        'message' => 'mode setting is invalid',
    ],
    'transfer_in_error' => [
        'code' => 17,
        'message' => 'transfer in error',
    ],
    'transfer_out_error' => [
        'code' => 18,
        'message' => 'transfer out error',
    ],
    'player_credit_is_not_enough' => [
        'code' => 19,
        'message' => 'player credit is not enough',
    ],
    'account_has_been_used' => [
        'code' => 20,
        'message' => 'account:%s has been used',
    ],
    'player_have_not_yet_checkout_bet' => [
        'code' => 21,
        'message' => 'player have not yet checkout bet',
    ],
    'param_must_be_a_unsigned_integer' => [
        'code' => 22,
        'message' => '%s must be a unsigned integer',
    ],
    '[startAt_or_endAt]_value_must_be_datetime' => [
        'code' => 23,
        'message' => '[startAt or endAt] value must be datetime Example：2017-01-01 00:00:00',
    ],
    'transferId_is_not_exist' => [
        'code' => 24,
        'message' => '%s is not exist',
    ],
    'transferId_can_not_be_empty' => [
        'code' => 25,
        'message' => 'transfer id can not be empty',
    ],
    'transferId_has_been_used' => [
        'code' => 26,
        'message' => 'transfer id: %s has been used',
    ],
    'transfer_in_or_out_can_not_be_0' => [
        'code' => 27,
        'message' => 'transfer in or out can not be 0',
    ],
    'transferId_transaction_processing' => [
        'code' => 28,
        'message' => 'transfer id: %s transaction processing',
    ],
    'params_is_must_be_alpha_num' => [
        'code' => 29,
        'message' => '%s must be entirely alpha-numeric characters',
    ],
    'param_must_be_a_unsigned_decimal' => [
        'code' => 30,
        'message' => '%s must be a unsigned decimal',
    ],
    'param_must_be_a_integer' => [
        'code' => 31,
        'message' => '%s must be a integer',
    ],
    'player_mode_is_been_disabled' => [
        'code' => 32,
        'message' => 'player mode is been disabled',
    ],
    'player_enable_is_been_disabled' => [
        'code' => 33,
        'message' => 'player enable is been disabled',
    ],
    'table_type_code_not_found' => [
        'code' => 34,
        'message' => 'tableType:%s not found',
    ],
    'player_stake_limit_setting_overflow_five' => [
        'code' => 35,
        'message' => 'player stake limit setting max five count',
    ],
    'player_stake_limit_setting_is_invalid' => [
        'code' => 36,
        'message' => 'player stake limit setting value [%s] is invalid',
    ],
    'platform_type_is_invalid' => [
        'code' => 37,
        'message' => 'platform type [%s] is invalid',
    ],
    'cash_type_is_invalid' => [
        'code' => 38,
        'message' => 'The cashtype is invalid',
    ],
    'credit_reset_is_pending' => [
        'code' => 39,
        'message' => 'The credit reset action is pending',
    ],
    'params_is_must_be_num' => [
        'code' => 40,
        'message' => '%s must be a unsigned integer, and only numeric characters',
    ],
    'params_is_must_between_1_and_0' => [
        'code' => 41,
        'message' => '%s must between 1 and 0',
    ],
    'params_is_must_be_dec' => [
        'code' => 42,
        'message' => '%s must be a unsigned decimal, and only numeric characters',
    ],
    'currency_is_not_supported' => [
        'code' => 102,
        'message' => 'The currency: %s is not supported',
    ],
    'language_is_not_supported' => [
        'code' => 103,
        'message' => 'The language is not supported',
    ],
    'server_body_content_is_invalid' => [
        'code' => 1,
        'message' => 'server request body content is invalid, please check again',
    ],
    'reset_group_not_found_player' => [
        'code' => 43,
        'message' => 'reset group id not found player',
    ],
    'player_credit_reset_is_pending' => [
        'code' => 44,
        'message' => 'player credit reset is pending',
    ],
    'limit_setting_level_is_not_allow' => [
        'code' => 45,
        'message' => 'setting limitId:%d level is %s, platform limit level can set %s level',
    ],
    'multi-credit-player-reset-do-not-allow-no-reset' => [
        'code' => 46,
        'message' => 'multi credit player reset do not allow call zero',
    ],
    'marquee_is_not_found' => [
        'code' => 47,
        'message' => 'marqueeId:%s is not found',
    ],
    'location_code_is_invalid' => [
        'code' => 48,
        'message' => 'location:%s is invalid',
    ],
    'marquee_date_range_is_invalid' => [
        'code' => 49,
        'message' => 'marquee date range startAt:%s ~ endAt:%s is invalid',
    ],
    'refund_range_invalid' => [
        'code' => 50,
        'message' => 'refund set value 0 ~ 150, setting refund is:%s'
    ],
    'record_id_not_exist' => [
        'code' => 51,
        'message' => 'record id:%s is not exist'
    ],
    'maintain_time_range_is_invalid' => [
        'code' => 52,
        'message' => 'maintain time range is invalid startAt:%s ~ endAt:%s is invalid, At least half an hour'
    ],
    'maintain_record_is_require_record_id_or_time_range' => [
        'code' => 53,
        'message' => 'get maintain record is need recordId or startAt and endAt'
    ],
];
