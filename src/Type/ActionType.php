<?php
namespace Plexo\Sdk\Type;

abstract class ActionType
{
    const SELECT_INSTRUMENT       = 0b000001;
    const REGISTER_INSTRUMENT     = 0b000010;
    const DELETE_INSTRUMENT       = 0b000100;
    const SESSION_EXTEND_AMOUNT   = 0b001000;
    const CLIENT_EXTEND_AMOUNT    = 0b010000;
    const ASK_FOR_TEMPORARY_ITEMS = 0b100000;
}
