<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit73ce08e6b9ba2b72ef01c3a5d083983d
{
    public static $files = array (
        '0e6d7bf4a5811bfa5cf40c5ccd6fae6a' => __DIR__ . '/..' . '/symfony/polyfill-mbstring/bootstrap.php',
        '25072dd6e2470089de65ae7bf11d3109' => __DIR__ . '/..' . '/symfony/polyfill-php72/bootstrap.php',
        '667aeda72477189d0494fecd327c3641' => __DIR__ . '/..' . '/symfony/var-dumper/Resources/functions/dump.php',
    );

    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Symfony\\Polyfill\\Php72\\' => 23,
            'Symfony\\Polyfill\\Mbstring\\' => 26,
            'Symfony\\Component\\VarDumper\\' => 28,
        ),
        'P' => 
        array (
            'Psr\\Log\\' => 8,
        ),
        'M' => 
        array (
            'Monolog\\' => 8,
        ),
        'L' => 
        array (
            'Local\\Core\\' => 11,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Symfony\\Polyfill\\Php72\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-php72',
        ),
        'Symfony\\Polyfill\\Mbstring\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-mbstring',
        ),
        'Symfony\\Component\\VarDumper\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/var-dumper',
        ),
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/Psr/Log',
        ),
        'Monolog\\' => 
        array (
            0 => __DIR__ . '/..' . '/monolog/monolog/src/Monolog',
        ),
        'Local\\Core\\' => 
        array (
            0 => __DIR__ . '/../..' . '/LocalCore',
        ),
    );

    public static $classMap = array (
        'Local\\Core\\Ajax\\Exception\\MethodNotExistException' => __DIR__ . '/../..' . '/LocalCore/Ajax/Exception/MethodNotExistException.php',
        'Local\\Core\\Ajax\\Exception\\RouteNotFoundException' => __DIR__ . '/../..' . '/LocalCore/Ajax/Exception/RouteNotFoundException.php',
        'Local\\Core\\Ajax\\Exception\\StructureHandlerNotExistException' => __DIR__ . '/../..' . '/LocalCore/Ajax/Exception/StructureHandlerNotExistException.php',
        'Local\\Core\\Ajax\\Exception\\StructurePathNotExistException' => __DIR__ . '/../..' . '/LocalCore/Ajax/Exception/StructurePathNotExistException.php',
        'Local\\Core\\Ajax\\Handler\\Consult' => __DIR__ . '/../..' . '/LocalCore/Ajax/Handler/Consult.php',
        'Local\\Core\\Ajax\\Handler\\Example' => __DIR__ . '/../..' . '/LocalCore/Ajax/Handler/Example.php',
        'Local\\Core\\Ajax\\Handler\\Services' => __DIR__ . '/../..' . '/LocalCore/Ajax/Handler/Services.php',
        'Local\\Core\\Assistant\\Consult' => __DIR__ . '/../..' . '/LocalCore/Assistant/Consult.php',
        'Local\\Core\\Assistant\\Iblock' => __DIR__ . '/../..' . '/LocalCore/Assistant/Iblock.php',
        'Local\\Core\\Assistant\\Iblock\\ElementProperty' => __DIR__ . '/../..' . '/LocalCore/Assistant/Iblock/ElementProperty.php',
        'Local\\Core\\Assistant\\Useful' => __DIR__ . '/../..' . '/LocalCore/Assistant/Useful.php',
        'Local\\Core\\EventHandlers\\Base' => __DIR__ . '/../..' . '/LocalCore/EventHandlers/Base.php',
        'Local\\Core\\EventHandlers\\Iblock\\OnAfterIBlockElementUpdate' => __DIR__ . '/../..' . '/LocalCore/EventHandlers/Iblock/OnAfterIBlockElementUpdate.php',
        'Local\\Core\\EventHandlers\\Iblock\\OnBeforeIBlockElementUpdate' => __DIR__ . '/../..' . '/LocalCore/EventHandlers/Iblock/OnBeforeIBlockElementUpdate.php',
        'Local\\Core\\EventHandlers\\Main\\OnEndBufferContentHandler' => __DIR__ . '/../..' . '/LocalCore/EventHandlers/Main/OnEndBufferContentHandler.php',
        'Local\\Core\\Exception\\Component\\Services\\Exception404' => __DIR__ . '/../..' . '/LocalCore/Exception/Component/Services/Exception404.php',
        'Local\\Core\\Exception\\Component\\Services\\ExceptionEmptyData' => __DIR__ . '/../..' . '/LocalCore/Exception/Component/Services/ExceptionEmptyData.php',
        'Local\\Core\\Exception\\Component\\Services\\ExceptionEmptyReviewId' => __DIR__ . '/../..' . '/LocalCore/Exception/Component/Services/ExceptionEmptyReviewId.php',
        'Local\\Core\\HighloadBlock\\Entity' => __DIR__ . '/../..' . '/LocalCore/HighloadBlock/Entity.php',
        'Local\\Core\\HighloadBlock\\FieldEnumTable' => __DIR__ . '/../..' . '/LocalCore/HighloadBlock/FieldEnumTable.php',
        'Local\\Core\\Inner\\BxModified\\CBitrixComponent' => __DIR__ . '/../..' . '/LocalCore/Inner/BxModified/CBitrixComponent.php',
        'Local\\Core\\Inner\\BxModified\\CFile' => __DIR__ . '/../..' . '/LocalCore/Inner/BxModified/CFile.php',
        'Local\\Core\\Inner\\BxModified\\HttpResponse' => __DIR__ . '/../..' . '/LocalCore/Inner/BxModified/HttpResponse.php',
        'Local\\Core\\Inner\\Logger' => __DIR__ . '/../..' . '/LocalCore/Inner/Logger.php',
        'Local\\Core\\Inner\\Result' => __DIR__ . '/../..' . '/LocalCore/Inner/Result.php',
        'Local\\Core\\Model\\Bitrix\\ElementPropertyTable' => __DIR__ . '/../..' . '/LocalCore/Model/Bitrix/ElementPropertyTable.php',
        'Local\\Core\\Page' => __DIR__ . '/../..' . '/LocalCore/Page.php',
        'Local\\Core\\Register\\ServicesComponent' => __DIR__ . '/../..' . '/LocalCore/Register/ServicesComponent.php',
        'Local\\Core\\Text\\Format\\BaseFormat' => __DIR__ . '/../..' . '/LocalCore/Text/Format/BaseFormat.php',
        'Local\\Core\\Text\\Format\\FormatCommon' => __DIR__ . '/../..' . '/LocalCore/Text/Format/FormatCommon.php',
        'Local\\Core\\Text\\Format\\FormatNewLine' => __DIR__ . '/../..' . '/LocalCore/Text/Format/FormatNewLine.php',
        'Local\\Core\\Text\\Format\\FormatSnippetAnatationBlock' => __DIR__ . '/../..' . '/LocalCore/Text/Format/FormatSnippetAnatationBlock.php',
        'Local\\Core\\Text\\Format\\FormatSnippetAnatationBlockConsult' => __DIR__ . '/../..' . '/LocalCore/Text/Format/FormatSnippetAnatationBlockConsult.php',
        'Local\\Core\\Text\\Format\\FormatSnippetBlockQuote' => __DIR__ . '/../..' . '/LocalCore/Text/Format/FormatSnippetBlockQuote.php',
        'Local\\Core\\Text\\Format\\FormatSnippetInfoBlock' => __DIR__ . '/../..' . '/LocalCore/Text/Format/FormatSnippetInfoBlock.php',
        'Local\\Core\\Text\\Format\\FormatSnippetPhotoGallery' => __DIR__ . '/../..' . '/LocalCore/Text/Format/FormatSnippetPhotoGallery.php',
        'Local\\Core\\Text\\Format\\FormatSnippetServiceVideo' => __DIR__ . '/../..' . '/LocalCore/Text/Format/FormatSnippetServiceVideo.php',
        'Local\\Core\\Text\\Format\\FormatSnippetTwoColumn' => __DIR__ . '/../..' . '/LocalCore/Text/Format/FormatSnippetTwoColumn.php',
        'Local\\Core\\Text\\Format\\FormatSnippetVideoBlock' => __DIR__ . '/../..' . '/LocalCore/Text/Format/FormatSnippetVideoBlock.php',
        'Local\\Core\\Text\\Format\\FormatStripTags' => __DIR__ . '/../..' . '/LocalCore/Text/Format/FormatStripTags.php',
        'Local\\Core\\Text\\Format\\FormatTrim' => __DIR__ . '/../..' . '/LocalCore/Text/Format/FormatTrim.php',
        'Local\\Core\\TriggerMail\\Consult' => __DIR__ . '/../..' . '/LocalCore/TriggerMail/Consult.php',
        'Local\\Core\\TriggerMail\\Services' => __DIR__ . '/../..' . '/LocalCore/TriggerMail/Services.php',
        'Monolog\\ErrorHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/ErrorHandler.php',
        'Monolog\\Formatter\\ChromePHPFormatter' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Formatter/ChromePHPFormatter.php',
        'Monolog\\Formatter\\ElasticaFormatter' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Formatter/ElasticaFormatter.php',
        'Monolog\\Formatter\\FlowdockFormatter' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Formatter/FlowdockFormatter.php',
        'Monolog\\Formatter\\FluentdFormatter' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Formatter/FluentdFormatter.php',
        'Monolog\\Formatter\\FormatterInterface' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Formatter/FormatterInterface.php',
        'Monolog\\Formatter\\GelfMessageFormatter' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Formatter/GelfMessageFormatter.php',
        'Monolog\\Formatter\\HtmlFormatter' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Formatter/HtmlFormatter.php',
        'Monolog\\Formatter\\JsonFormatter' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Formatter/JsonFormatter.php',
        'Monolog\\Formatter\\LineFormatter' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Formatter/LineFormatter.php',
        'Monolog\\Formatter\\LogglyFormatter' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Formatter/LogglyFormatter.php',
        'Monolog\\Formatter\\LogstashFormatter' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Formatter/LogstashFormatter.php',
        'Monolog\\Formatter\\MongoDBFormatter' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Formatter/MongoDBFormatter.php',
        'Monolog\\Formatter\\NormalizerFormatter' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Formatter/NormalizerFormatter.php',
        'Monolog\\Formatter\\ScalarFormatter' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Formatter/ScalarFormatter.php',
        'Monolog\\Formatter\\WildfireFormatter' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Formatter/WildfireFormatter.php',
        'Monolog\\Handler\\AbstractHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/AbstractHandler.php',
        'Monolog\\Handler\\AbstractProcessingHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/AbstractProcessingHandler.php',
        'Monolog\\Handler\\AbstractSyslogHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/AbstractSyslogHandler.php',
        'Monolog\\Handler\\AmqpHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/AmqpHandler.php',
        'Monolog\\Handler\\BrowserConsoleHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/BrowserConsoleHandler.php',
        'Monolog\\Handler\\BufferHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/BufferHandler.php',
        'Monolog\\Handler\\ChromePHPHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/ChromePHPHandler.php',
        'Monolog\\Handler\\CouchDBHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/CouchDBHandler.php',
        'Monolog\\Handler\\CubeHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/CubeHandler.php',
        'Monolog\\Handler\\Curl\\Util' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/Curl/Util.php',
        'Monolog\\Handler\\DeduplicationHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/DeduplicationHandler.php',
        'Monolog\\Handler\\DoctrineCouchDBHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/DoctrineCouchDBHandler.php',
        'Monolog\\Handler\\DynamoDbHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/DynamoDbHandler.php',
        'Monolog\\Handler\\ElasticSearchHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/ElasticSearchHandler.php',
        'Monolog\\Handler\\ErrorLogHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/ErrorLogHandler.php',
        'Monolog\\Handler\\FilterHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/FilterHandler.php',
        'Monolog\\Handler\\FingersCrossedHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/FingersCrossedHandler.php',
        'Monolog\\Handler\\FingersCrossed\\ActivationStrategyInterface' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/FingersCrossed/ActivationStrategyInterface.php',
        'Monolog\\Handler\\FingersCrossed\\ChannelLevelActivationStrategy' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/FingersCrossed/ChannelLevelActivationStrategy.php',
        'Monolog\\Handler\\FingersCrossed\\ErrorLevelActivationStrategy' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/FingersCrossed/ErrorLevelActivationStrategy.php',
        'Monolog\\Handler\\FirePHPHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/FirePHPHandler.php',
        'Monolog\\Handler\\FleepHookHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/FleepHookHandler.php',
        'Monolog\\Handler\\FlowdockHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/FlowdockHandler.php',
        'Monolog\\Handler\\FormattableHandlerInterface' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/FormattableHandlerInterface.php',
        'Monolog\\Handler\\FormattableHandlerTrait' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/FormattableHandlerTrait.php',
        'Monolog\\Handler\\GelfHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/GelfHandler.php',
        'Monolog\\Handler\\GroupHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/GroupHandler.php',
        'Monolog\\Handler\\HandlerInterface' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/HandlerInterface.php',
        'Monolog\\Handler\\HandlerWrapper' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/HandlerWrapper.php',
        'Monolog\\Handler\\HipChatHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/HipChatHandler.php',
        'Monolog\\Handler\\IFTTTHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/IFTTTHandler.php',
        'Monolog\\Handler\\InsightOpsHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/InsightOpsHandler.php',
        'Monolog\\Handler\\LogEntriesHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/LogEntriesHandler.php',
        'Monolog\\Handler\\LogglyHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/LogglyHandler.php',
        'Monolog\\Handler\\MailHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/MailHandler.php',
        'Monolog\\Handler\\MandrillHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/MandrillHandler.php',
        'Monolog\\Handler\\MissingExtensionException' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/MissingExtensionException.php',
        'Monolog\\Handler\\MongoDBHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/MongoDBHandler.php',
        'Monolog\\Handler\\NativeMailerHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/NativeMailerHandler.php',
        'Monolog\\Handler\\NewRelicHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/NewRelicHandler.php',
        'Monolog\\Handler\\NullHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/NullHandler.php',
        'Monolog\\Handler\\PHPConsoleHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/PHPConsoleHandler.php',
        'Monolog\\Handler\\ProcessableHandlerInterface' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/ProcessableHandlerInterface.php',
        'Monolog\\Handler\\ProcessableHandlerTrait' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/ProcessableHandlerTrait.php',
        'Monolog\\Handler\\PsrHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/PsrHandler.php',
        'Monolog\\Handler\\PushoverHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/PushoverHandler.php',
        'Monolog\\Handler\\RavenHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/RavenHandler.php',
        'Monolog\\Handler\\RedisHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/RedisHandler.php',
        'Monolog\\Handler\\RollbarHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/RollbarHandler.php',
        'Monolog\\Handler\\RotatingFileHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/RotatingFileHandler.php',
        'Monolog\\Handler\\SamplingHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/SamplingHandler.php',
        'Monolog\\Handler\\SlackHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/SlackHandler.php',
        'Monolog\\Handler\\SlackWebhookHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/SlackWebhookHandler.php',
        'Monolog\\Handler\\Slack\\SlackRecord' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/Slack/SlackRecord.php',
        'Monolog\\Handler\\SlackbotHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/SlackbotHandler.php',
        'Monolog\\Handler\\SocketHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/SocketHandler.php',
        'Monolog\\Handler\\StreamHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/StreamHandler.php',
        'Monolog\\Handler\\SwiftMailerHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/SwiftMailerHandler.php',
        'Monolog\\Handler\\SyslogHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/SyslogHandler.php',
        'Monolog\\Handler\\SyslogUdpHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/SyslogUdpHandler.php',
        'Monolog\\Handler\\SyslogUdp\\UdpSocket' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/SyslogUdp/UdpSocket.php',
        'Monolog\\Handler\\TestHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/TestHandler.php',
        'Monolog\\Handler\\WhatFailureGroupHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/WhatFailureGroupHandler.php',
        'Monolog\\Handler\\ZendMonitorHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Handler/ZendMonitorHandler.php',
        'Monolog\\Logger' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Logger.php',
        'Monolog\\Processor\\GitProcessor' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Processor/GitProcessor.php',
        'Monolog\\Processor\\IntrospectionProcessor' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Processor/IntrospectionProcessor.php',
        'Monolog\\Processor\\MemoryPeakUsageProcessor' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Processor/MemoryPeakUsageProcessor.php',
        'Monolog\\Processor\\MemoryProcessor' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Processor/MemoryProcessor.php',
        'Monolog\\Processor\\MemoryUsageProcessor' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Processor/MemoryUsageProcessor.php',
        'Monolog\\Processor\\MercurialProcessor' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Processor/MercurialProcessor.php',
        'Monolog\\Processor\\ProcessIdProcessor' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Processor/ProcessIdProcessor.php',
        'Monolog\\Processor\\ProcessorInterface' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Processor/ProcessorInterface.php',
        'Monolog\\Processor\\PsrLogMessageProcessor' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Processor/PsrLogMessageProcessor.php',
        'Monolog\\Processor\\TagProcessor' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Processor/TagProcessor.php',
        'Monolog\\Processor\\UidProcessor' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Processor/UidProcessor.php',
        'Monolog\\Processor\\WebProcessor' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Processor/WebProcessor.php',
        'Monolog\\Registry' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Registry.php',
        'Monolog\\ResettableInterface' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/ResettableInterface.php',
        'Monolog\\SignalHandler' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/SignalHandler.php',
        'Monolog\\Utils' => __DIR__ . '/..' . '/monolog/monolog/src/Monolog/Utils.php',
        'Psr\\Log\\AbstractLogger' => __DIR__ . '/..' . '/psr/log/Psr/Log/AbstractLogger.php',
        'Psr\\Log\\InvalidArgumentException' => __DIR__ . '/..' . '/psr/log/Psr/Log/InvalidArgumentException.php',
        'Psr\\Log\\LogLevel' => __DIR__ . '/..' . '/psr/log/Psr/Log/LogLevel.php',
        'Psr\\Log\\LoggerAwareInterface' => __DIR__ . '/..' . '/psr/log/Psr/Log/LoggerAwareInterface.php',
        'Psr\\Log\\LoggerAwareTrait' => __DIR__ . '/..' . '/psr/log/Psr/Log/LoggerAwareTrait.php',
        'Psr\\Log\\LoggerInterface' => __DIR__ . '/..' . '/psr/log/Psr/Log/LoggerInterface.php',
        'Psr\\Log\\LoggerTrait' => __DIR__ . '/..' . '/psr/log/Psr/Log/LoggerTrait.php',
        'Psr\\Log\\NullLogger' => __DIR__ . '/..' . '/psr/log/Psr/Log/NullLogger.php',
        'Psr\\Log\\Test\\DummyTest' => __DIR__ . '/..' . '/psr/log/Psr/Log/Test/LoggerInterfaceTest.php',
        'Psr\\Log\\Test\\LoggerInterfaceTest' => __DIR__ . '/..' . '/psr/log/Psr/Log/Test/LoggerInterfaceTest.php',
        'Psr\\Log\\Test\\TestLogger' => __DIR__ . '/..' . '/psr/log/Psr/Log/Test/TestLogger.php',
        'Symfony\\Component\\VarDumper\\Caster\\AmqpCaster' => __DIR__ . '/..' . '/symfony/var-dumper/Caster/AmqpCaster.php',
        'Symfony\\Component\\VarDumper\\Caster\\ArgsStub' => __DIR__ . '/..' . '/symfony/var-dumper/Caster/ArgsStub.php',
        'Symfony\\Component\\VarDumper\\Caster\\Caster' => __DIR__ . '/..' . '/symfony/var-dumper/Caster/Caster.php',
        'Symfony\\Component\\VarDumper\\Caster\\ClassStub' => __DIR__ . '/..' . '/symfony/var-dumper/Caster/ClassStub.php',
        'Symfony\\Component\\VarDumper\\Caster\\ConstStub' => __DIR__ . '/..' . '/symfony/var-dumper/Caster/ConstStub.php',
        'Symfony\\Component\\VarDumper\\Caster\\CutArrayStub' => __DIR__ . '/..' . '/symfony/var-dumper/Caster/CutArrayStub.php',
        'Symfony\\Component\\VarDumper\\Caster\\CutStub' => __DIR__ . '/..' . '/symfony/var-dumper/Caster/CutStub.php',
        'Symfony\\Component\\VarDumper\\Caster\\DOMCaster' => __DIR__ . '/..' . '/symfony/var-dumper/Caster/DOMCaster.php',
        'Symfony\\Component\\VarDumper\\Caster\\DateCaster' => __DIR__ . '/..' . '/symfony/var-dumper/Caster/DateCaster.php',
        'Symfony\\Component\\VarDumper\\Caster\\DoctrineCaster' => __DIR__ . '/..' . '/symfony/var-dumper/Caster/DoctrineCaster.php',
        'Symfony\\Component\\VarDumper\\Caster\\DsCaster' => __DIR__ . '/..' . '/symfony/var-dumper/Caster/DsCaster.php',
        'Symfony\\Component\\VarDumper\\Caster\\DsPairStub' => __DIR__ . '/..' . '/symfony/var-dumper/Caster/DsPairStub.php',
        'Symfony\\Component\\VarDumper\\Caster\\EnumStub' => __DIR__ . '/..' . '/symfony/var-dumper/Caster/EnumStub.php',
        'Symfony\\Component\\VarDumper\\Caster\\ExceptionCaster' => __DIR__ . '/..' . '/symfony/var-dumper/Caster/ExceptionCaster.php',
        'Symfony\\Component\\VarDumper\\Caster\\FrameStub' => __DIR__ . '/..' . '/symfony/var-dumper/Caster/FrameStub.php',
        'Symfony\\Component\\VarDumper\\Caster\\GmpCaster' => __DIR__ . '/..' . '/symfony/var-dumper/Caster/GmpCaster.php',
        'Symfony\\Component\\VarDumper\\Caster\\IntlCaster' => __DIR__ . '/..' . '/symfony/var-dumper/Caster/IntlCaster.php',
        'Symfony\\Component\\VarDumper\\Caster\\LinkStub' => __DIR__ . '/..' . '/symfony/var-dumper/Caster/LinkStub.php',
        'Symfony\\Component\\VarDumper\\Caster\\MemcachedCaster' => __DIR__ . '/..' . '/symfony/var-dumper/Caster/MemcachedCaster.php',
        'Symfony\\Component\\VarDumper\\Caster\\PdoCaster' => __DIR__ . '/..' . '/symfony/var-dumper/Caster/PdoCaster.php',
        'Symfony\\Component\\VarDumper\\Caster\\PgSqlCaster' => __DIR__ . '/..' . '/symfony/var-dumper/Caster/PgSqlCaster.php',
        'Symfony\\Component\\VarDumper\\Caster\\ProxyManagerCaster' => __DIR__ . '/..' . '/symfony/var-dumper/Caster/ProxyManagerCaster.php',
        'Symfony\\Component\\VarDumper\\Caster\\RedisCaster' => __DIR__ . '/..' . '/symfony/var-dumper/Caster/RedisCaster.php',
        'Symfony\\Component\\VarDumper\\Caster\\ReflectionCaster' => __DIR__ . '/..' . '/symfony/var-dumper/Caster/ReflectionCaster.php',
        'Symfony\\Component\\VarDumper\\Caster\\ResourceCaster' => __DIR__ . '/..' . '/symfony/var-dumper/Caster/ResourceCaster.php',
        'Symfony\\Component\\VarDumper\\Caster\\SplCaster' => __DIR__ . '/..' . '/symfony/var-dumper/Caster/SplCaster.php',
        'Symfony\\Component\\VarDumper\\Caster\\StubCaster' => __DIR__ . '/..' . '/symfony/var-dumper/Caster/StubCaster.php',
        'Symfony\\Component\\VarDumper\\Caster\\SymfonyCaster' => __DIR__ . '/..' . '/symfony/var-dumper/Caster/SymfonyCaster.php',
        'Symfony\\Component\\VarDumper\\Caster\\TraceStub' => __DIR__ . '/..' . '/symfony/var-dumper/Caster/TraceStub.php',
        'Symfony\\Component\\VarDumper\\Caster\\XmlReaderCaster' => __DIR__ . '/..' . '/symfony/var-dumper/Caster/XmlReaderCaster.php',
        'Symfony\\Component\\VarDumper\\Caster\\XmlResourceCaster' => __DIR__ . '/..' . '/symfony/var-dumper/Caster/XmlResourceCaster.php',
        'Symfony\\Component\\VarDumper\\Cloner\\AbstractCloner' => __DIR__ . '/..' . '/symfony/var-dumper/Cloner/AbstractCloner.php',
        'Symfony\\Component\\VarDumper\\Cloner\\ClonerInterface' => __DIR__ . '/..' . '/symfony/var-dumper/Cloner/ClonerInterface.php',
        'Symfony\\Component\\VarDumper\\Cloner\\Cursor' => __DIR__ . '/..' . '/symfony/var-dumper/Cloner/Cursor.php',
        'Symfony\\Component\\VarDumper\\Cloner\\Data' => __DIR__ . '/..' . '/symfony/var-dumper/Cloner/Data.php',
        'Symfony\\Component\\VarDumper\\Cloner\\DumperInterface' => __DIR__ . '/..' . '/symfony/var-dumper/Cloner/DumperInterface.php',
        'Symfony\\Component\\VarDumper\\Cloner\\Stub' => __DIR__ . '/..' . '/symfony/var-dumper/Cloner/Stub.php',
        'Symfony\\Component\\VarDumper\\Cloner\\VarCloner' => __DIR__ . '/..' . '/symfony/var-dumper/Cloner/VarCloner.php',
        'Symfony\\Component\\VarDumper\\Command\\Descriptor\\CliDescriptor' => __DIR__ . '/..' . '/symfony/var-dumper/Command/Descriptor/CliDescriptor.php',
        'Symfony\\Component\\VarDumper\\Command\\Descriptor\\DumpDescriptorInterface' => __DIR__ . '/..' . '/symfony/var-dumper/Command/Descriptor/DumpDescriptorInterface.php',
        'Symfony\\Component\\VarDumper\\Command\\Descriptor\\HtmlDescriptor' => __DIR__ . '/..' . '/symfony/var-dumper/Command/Descriptor/HtmlDescriptor.php',
        'Symfony\\Component\\VarDumper\\Command\\ServerDumpCommand' => __DIR__ . '/..' . '/symfony/var-dumper/Command/ServerDumpCommand.php',
        'Symfony\\Component\\VarDumper\\Dumper\\AbstractDumper' => __DIR__ . '/..' . '/symfony/var-dumper/Dumper/AbstractDumper.php',
        'Symfony\\Component\\VarDumper\\Dumper\\CliDumper' => __DIR__ . '/..' . '/symfony/var-dumper/Dumper/CliDumper.php',
        'Symfony\\Component\\VarDumper\\Dumper\\ContextProvider\\CliContextProvider' => __DIR__ . '/..' . '/symfony/var-dumper/Dumper/ContextProvider/CliContextProvider.php',
        'Symfony\\Component\\VarDumper\\Dumper\\ContextProvider\\ContextProviderInterface' => __DIR__ . '/..' . '/symfony/var-dumper/Dumper/ContextProvider/ContextProviderInterface.php',
        'Symfony\\Component\\VarDumper\\Dumper\\ContextProvider\\RequestContextProvider' => __DIR__ . '/..' . '/symfony/var-dumper/Dumper/ContextProvider/RequestContextProvider.php',
        'Symfony\\Component\\VarDumper\\Dumper\\ContextProvider\\SourceContextProvider' => __DIR__ . '/..' . '/symfony/var-dumper/Dumper/ContextProvider/SourceContextProvider.php',
        'Symfony\\Component\\VarDumper\\Dumper\\DataDumperInterface' => __DIR__ . '/..' . '/symfony/var-dumper/Dumper/DataDumperInterface.php',
        'Symfony\\Component\\VarDumper\\Dumper\\HtmlDumper' => __DIR__ . '/..' . '/symfony/var-dumper/Dumper/HtmlDumper.php',
        'Symfony\\Component\\VarDumper\\Dumper\\ServerDumper' => __DIR__ . '/..' . '/symfony/var-dumper/Dumper/ServerDumper.php',
        'Symfony\\Component\\VarDumper\\Exception\\ThrowingCasterException' => __DIR__ . '/..' . '/symfony/var-dumper/Exception/ThrowingCasterException.php',
        'Symfony\\Component\\VarDumper\\Server\\Connection' => __DIR__ . '/..' . '/symfony/var-dumper/Server/Connection.php',
        'Symfony\\Component\\VarDumper\\Server\\DumpServer' => __DIR__ . '/..' . '/symfony/var-dumper/Server/DumpServer.php',
        'Symfony\\Component\\VarDumper\\Test\\VarDumperTestTrait' => __DIR__ . '/..' . '/symfony/var-dumper/Test/VarDumperTestTrait.php',
        'Symfony\\Component\\VarDumper\\VarDumper' => __DIR__ . '/..' . '/symfony/var-dumper/VarDumper.php',
        'Symfony\\Polyfill\\Mbstring\\Mbstring' => __DIR__ . '/..' . '/symfony/polyfill-mbstring/Mbstring.php',
        'Symfony\\Polyfill\\Php72\\Php72' => __DIR__ . '/..' . '/symfony/polyfill-php72/Php72.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit73ce08e6b9ba2b72ef01c3a5d083983d::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit73ce08e6b9ba2b72ef01c3a5d083983d::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit73ce08e6b9ba2b72ef01c3a5d083983d::$classMap;

        }, null, ClassLoader::class);
    }
}
